import $ from "jquery";

class DetailsTable {
    constructor() {
        this.detailsButton = $(".details-button");
        this.detailsTable = $(".details-table")
        this.events();
    }

    events() {
        this.detailsButton.click(this.toggleTable.bind(this));
    }

    toggleTable() {
        this.detailsTable.toggleClass("details-table--visible");
    }
}

export default DetailsTable;