function fetchAttendance() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../Control/fetchAttendance.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText); 
            var tableBody = document.querySelector('#attendanceTable tbody');
            tableBody.innerHTML = ''; 

            if (data.length > 0) {
                data.forEach(function(record) {
                    var row = document.createElement('tr');
                    var dateCell = document.createElement('td');
                    dateCell.textContent = record.date;
                    row.appendChild(dateCell);

                    var nameCell = document.createElement('td');
                    nameCell.textContent = record.name;
                    row.appendChild(nameCell);

                    var statusCell = document.createElement('td');
                    statusCell.textContent = record.status;
                    row.appendChild(statusCell);

                    tableBody.appendChild(row);
                });
            } else {
                var row = document.createElement('tr');
                var cell = document.createElement('td');
                cell.colSpan = 3;
                cell.textContent = 'No attendance records found.';
                row.appendChild(cell);
                tableBody.appendChild(row);
            }
        }
    };
    xhr.send();
}
