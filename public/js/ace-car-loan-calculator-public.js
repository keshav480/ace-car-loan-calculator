(function ($) {
  "use strict";

  document.querySelectorAll(".tooltips").forEach((tooltip) => {
    tooltip.addEventListener("click", function () {
      const tooltipText = this.nextElementSibling;
      tooltipText.style.display =
        tooltipText.style.display === "block" ? "none" : "block";
    });
  });

  document.querySelectorAll(".tooltips").forEach((tooltip) => {
    tooltip.addEventListener("mouseover", function () {
      //   setTimeout(() => {

      //   }, 100); // Delay for 300ms
      this.nextElementSibling.style.display = "block";
    });

    tooltip.addEventListener("mouseout", function () {
      this.nextElementSibling.style.display = "none";
    });
  });

  let html = "";
  let htmlYear = "";
  jQuery(document).ready(function ($) {
    $("#car-price").on("change", function () {
      $(this).val(currencyformatter.format(formatInput($(this).val())));
    });

    $("#trade-in-value").on("change", function () {
      $(this).val(currencyformatter.format(formatInput($(this).val())));
    });

    $("#trade-in-tax-allowance").on("change", function () {
      $(this).val(currencyformatter.format(formatInput($(this).val())));
    });

    $("#down-payment").on("change", function () {
      $(this).val(currencyformatter.format(formatInput($(this).val())));
    });

    $("#cash-rebates").on("change", function () {
      $(this).val(currencyformatter.format(formatInput($(this).val())));
    });

    //calculate the loan term

    $("#calculate").on("click", function () {
      if (ace_settings.ace_amortization_type === "annual") {
        setTimeout(function () {
          $("#annualSchedule").trigger("click");
        }, 500);
      }
      html = "";
      htmlYear = "";
      let carPrice = extractNumbers($("#car-price").val());
      let tradeInValue = extractNumbers($("#trade-in-value").val());
      let tradeInAllowance = extractNumbers($("#trade-in-tax-allowance").val());
      let downPayment = extractNumbers($("#down-payment").val());
      let cashRebates = extractNumbers($("#cash-rebates").val());
      let taxRate = Number($("#tax-rate").val() / 100);
      let interestRate = Number($("#interest-rate").val() / 100);
      let loanTerm = Number($("#loan-term").val());
      if (isNaN(loanTerm)) {
        loanTerm = Number($("#loan-term-year").val()) * 12;
      }

      const monthlyInterestRate = interestRate / 12;

      //adjusted car price
      let adjustedPrice = carPrice - tradeInValue - cashRebates;
      let salesTaxAmount =
        (carPrice - (tradeInValue - tradeInAllowance)) * taxRate;
      let loanAmount = adjustedPrice + salesTaxAmount - downPayment;

      const numerator =
        monthlyInterestRate * Math.pow(1 + monthlyInterestRate, loanTerm);
      const denominator = Math.pow(1 + monthlyInterestRate, loanTerm) - 1;
      const monthlyPayment = loanAmount * (numerator / denominator);

      const totalLoanPayment = monthlyPayment * loanTerm;
      const loanInterest = totalLoanPayment - loanAmount;
      const totalCost = totalLoanPayment + downPayment;
      //populate data
      $(".result-section .paymentAmount").text(
        `Monthly Pay:  ${currencyformatter.format(monthlyPayment)}`
      );

      //populate table
      let tableData = `
            <tr>         
                <td class="title">Total Loan Amount</td>
                <td class="val">${currencyformatter.format(loanAmount)}</td>
            </tr>
             <tr>         
                <td class="title">Sale Tax</td>
                <td class="val">${currencyformatter.format(salesTaxAmount)}</td>
            </tr>
             <tr>         
                <td class="title">Upfront Payment</td>
                <td class="val">${currencyformatter.format(downPayment)}</td>
            </tr>`;

      let costCalc = `
            <tr>         
                <td class="title">Total of ${loanTerm} Loan Payments</td>
                <td class="val">${currencyformatter.format(
                  totalLoanPayment
                )}</td>
            </tr>
            <tr>         
                <td class="title">Total Loan Interest</td>
                <td class="val">${currencyformatter.format(loanInterest)}</td>
            </tr>
            <tr>         
                <td class="title">Total Cost (price, interest, tax, fees)</td>
                <td class="val">${currencyformatter.format(totalCost)}</td>
            </tr>`;

      document
        .querySelector(".result-section")
        .classList.remove("hidden-section");

      $(".result-section .data .loanData tbody").html(tableData);
      $(".result-section .data .interestData tbody").html(costCalc);

      calculateTable(loanAmount, loanTerm, monthlyInterestRate, monthlyPayment);
      //show chart
      Highcharts.chart("pie-chart", {
        chart: {
          type: "pie",
        },
        title: {
          text: "Loan Breakdown",
        },
        legend: {
          enabled: true,
        },
        tooltip: {
          formatter: function () {
            return `<b>${currencyformatter.format(
              this.y
            )}</b> (${this.percentage.toFixed(1)}%)`;
          },
          backgroundColor: "rgba(0, 0, 0, 0.75)",
          style: {
            color: "white",
          },
        },
        plotOptions: {
          pie: {
            innerSize: "50%",
            dataLabels: {
              enabled: true,
              format: "{point.percentage:.1f}%",
              style: {
                fontWeight: "bold",
                color: "white",
              },
              distance: -30,
            },
          },
        },
        series: [
          {
            data: [
              {
                name: "Principal",
                y: loanAmount,
              },
              {
                name: "Interest",
                y: Number(loanInterest.toFixed(2)),
              },
            ],
          },
        ],
        credits: { enabled: false },
      });
    });
  });

  function calculateTable(
    loanAmount,
    loanTerm,
    monthlyInterestRate,
    monthlyPayment
  ) {
    let remainingBalance = loanAmount;
    let amortizationSchedule = [];
    let year = 1;
    // Generate the schedule
    for (let month = 1; month <= loanTerm; month++) {
      let interestPayment = remainingBalance * monthlyInterestRate;
      let principalPayment = monthlyPayment - interestPayment;

      remainingBalance -= principalPayment;
      if (month === loanTerm) {
        remainingBalance = 0;
      }

      amortizationSchedule.push({
        month: month,
        interestPayment: interestPayment.toFixed(2),
        principalPayment: principalPayment.toFixed(2),
        totalPayment: monthlyPayment.toFixed(2),
        remainingBalance: remainingBalance.toFixed(2),
      });
    }

    let intersetSum = 0;
    let principalSum = 0;

    amortizationSchedule.forEach((el) => {
      intersetSum += Number(el.interestPayment);
      principalSum += Number(el.principalPayment);

      html += `<tr>
                <td>${el.month}</td>
                        <td>${currencyformatter.format(el.interestPayment)}</td>
                        <td>${currencyformatter.format(
                          el.principalPayment
                        )}</td>
                        <td>${currencyformatter.format(
                          el.remainingBalance
                        )}</td>
                </tr>
                `;
      if (Number(el.month) % 12 == 0) {
        htmlYear += `<tr>
                                    <td>${year}</td>
                                    <td>${currencyformatter.format(
                                      intersetSum
                                    )}</td>
                                    <td>${currencyformatter.format(
                                      principalSum
                                    )}</td>
                                    <td>${currencyformatter.format(
                                      el.remainingBalance
                                    )}</td>
                        </tr>`;

        html += `<tr>
                        <td colspan="4" class="year-count">End of Year ${year}</td>
                    </tr>`;
        year += 1;
        intersetSum = 0;
        principalSum = 0;
      }
    });
    jQuery(document).ready(function ($) {
      $(".amort-table table tbody").html(html);
      $("#monthlySchedule").addClass("active");
      $("#annualSchedule").removeClass("active");
    });
  }

  jQuery(document).ready(function ($) {
    $("#monthlySchedule").on("click", () => {
      $("#termText").text("Month");
      $("#monthlySchedule").addClass("active");
      $("#annualSchedule").removeClass("active");

      $(".amort-table table tbody").html(html);
    });

    $("#annualSchedule").on("click", () => {
      $("#termText").text("Year");
      $("#annualSchedule").addClass("active");
      $("#monthlySchedule").removeClass("active");

      $(".amort-table table tbody").html(htmlYear);
    });
  });

  function formatInput(inputString) {
    const cleanedInput = inputString.replace(/[^0-9.]/g, "");
    if (cleanedInput.length > 0) {
      return `${cleanedInput}`;
    } else {
      return "";
    }
  }

  let currency_symbol = ace_settings.currency_symbol || "₹";

  const symbolToCurrencyCode = {
    "₹": "INR",
    $: "USD",
    "£": "GBP",
  };
  let currency_code = symbolToCurrencyCode[currency_symbol] || "INR";

  // Create formatter
  let currencyformatter = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: currency_code,
    minimumFractionDigits: 0,
    maximumFractionDigits: 2,
  });

  function extractNumbers(inputString) {
    const extractedNumbers = inputString.replace(/[^0-9]/g, "");
    return Number(extractedNumbers);
  }
})(jQuery);
