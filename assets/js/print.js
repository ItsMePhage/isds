const Print = {
  printForm(formType, jsonData) {
    const encodedData = encodeURIComponent(JSON.stringify(jsonData));
    const printWindow = window.open(`../forms/${formType}-form.php?data=${encodedData}`, "_blank");
    printWindow.onload = () => {
      printWindow.print();
      printWindow.onafterprint = () => printWindow.close();
    };
  },

  init() {
    window.printoisbtn = (jsonData) => this.printForm("ois", jsonData);
    window.printmjrbtn = (jsonData) => this.printForm("mjr", jsonData);
    window.printpribtn = (jsonData) => this.printForm("pri", jsonData);
  },
};