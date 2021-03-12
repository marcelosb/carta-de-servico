export let Search = {

    run: function() {
        document.addEventListener('keyup', (event) => {
            const element = document.getElementById('search'), tbody = document.querySelector('tbody');
            if (this.isFind(element, event)) {
                this.getElements(element.value, Array.from(tbody.rows));
            }
        });
    },

    isFind: function(element, event) {
        return (element && element.contains(event.target));
    },

    getElements: function(element, tbody) {
        tbody.forEach((tr) => (this.exist(tr, element, 0)) || (this.exist(tr, element, 1)) ? this.showTableRow(tr) : this.hideTableRow(tr));
    },

    exist: function(tr, element, position) {
        return (tr.cells[position].textContent.toLowerCase().includes(element.toLowerCase()));
    },

    showTableRow: function(tr) {
        tr.style.display = 'table-row';
    },

    hideTableRow: function(tr) {
        tr.style.display = 'none';
    }
    
}
