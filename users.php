<?php
// Including header and sidebar
require_once "includes/sidebar.php";
require_once "includes/header.php";
require_once "includes/dataTablecss.php";

?>
<!-- checkbox -->
 <div class="container mt-5">
<div class="table-responsive">
<div class="table-container">
    <h2>Custom Data Table</h2>
    
    <div class="controls">
        <div>
            Show 
            <select id="entriesSelect">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select> entries
        </div>
        <input type="text" id="searchInput" placeholder="Search...">
        <div class="export-buttons">
            <input type="file" id="importExcel" accept=".xlsx, .xls" style="display:none;">
            <button class="import-btn" onclick="document.getElementById('importExcel').click()">Import Excel</button>
            <button onclick="exportCSV()">Export CSV</button>
            <button onclick="exportJSON()">Export JSON</button>
            <button onclick="exportPDF()">Export PDF</button>
            <button onclick="printTable()">Print</button>
        </div>
    </div>
    
    <div class="column-chooser">
        <strong>Columns:</strong>
        <label><input type="checkbox" class="colToggle" data-col="0" checked> ID</label>
        <label><input type="checkbox" class="colToggle" data-col="1" checked> Name</label>
        <label><input type="checkbox" class="colToggle" data-col="2" checked> Email</label>
        <label><input type="checkbox" class="colToggle" data-col="3" checked> Role</label>
    </div>
    
    <table id="dataTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Name</th>
                <th onclick="sortTable(2)">Email</th>
                <th onclick="sortTable(3)">Role</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- JS will populate rows -->
        </tbody>
    </table>
    
    <div class="pagination" id="pagination"></div>
</div>


  </div>
</div>
<?php
require_once "includes/footer.php";
require_once "includes/dataTablejs.php";
?>
