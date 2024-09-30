
       
        function addColumn() {
            const table = document.getElementById('gradeTable');
            const rows = table.rows;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const newCell = row.insertCell(-1);

                if (i === 0) {
                    newCell.textContent = 'Média';
                } else {
                    const cells = row.querySelectorAll('td');
                    const sum = Array.from(cells)
                        .slice(1, -1) 
                        .map(cell => parseFloat(cell.textContent) || 0);
                    const avg = sum.reduce((a, b) => a + b, 0) / sum.length;
                    newCell.textContent = avg.toFixed(2);
                }
            }
        }

     
        function addRow() {
            const table = document.getElementById('gradeTable');
            const tbody = table.querySelector('tbody');
            const newRow = tbody.insertRow();

            const numCols = table.rows[0].cells.length;

            for (let i = 0; i < numCols; i++) {
                const newCell = newRow.insertCell(i);
                if (i === 0) {
                    newCell.textContent = 'Novo Aluno';
                } else {
                    const sum = Array.from(tbody.querySelectorAll('tr')).map(row => parseFloat(row.cells[i].textContent) || 0);
                    const avg = sum.reduce((a, b) => a + b, 0) / sum.length;
                    newCell.textContent = avg.toFixed(2);
                }
            }
        }
    
