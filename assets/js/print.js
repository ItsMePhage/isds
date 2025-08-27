// print.js - Print Functions

$(function () {
  "use strict";

  // Generic print form function
  function printForm(formType, jsonData) {
    var encodedData = encodeURIComponent(JSON.stringify(jsonData));
    var printWindow = window.open(`../forms/${formType}-form.php?data=${encodedData}`, "_blank");

    printWindow.onload = function () {
      printWindow.print();
      printWindow.onafterprint = function () {
        printWindow.close();
      };
    };
  }

  // Print OIS form
  window.printoisbtn = function (jsonData) {
    printForm("ois", jsonData);
  };

  // Print MJR form
  window.printmjrbtn = function (jsonData) {
    printForm("mjr", jsonData);
  };

  // Print PRI form
  window.printpribtn = function (jsonData) {
    printForm("pri", jsonData);
  };

});