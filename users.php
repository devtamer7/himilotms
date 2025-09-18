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

    <!-- basic -->
                    <div x-data="modal" class="mb-5">
                        <!-- button -->
                        <div class="flex items-center justify-center">
                            <button type="button" class="btn btn-primary" @click="toggle">Add New User</button>
                        </div>
                    
                        <!-- modal -->
                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                            <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
                                <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-8 w-full max-w-lg">
                                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                        <div class="font-bold text-lg">Add New User</div>
                                        
                                    </div>
                                    <div class="p-5">
                                        <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                                        <form id="insertForm" method="post" class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-input">
                                            <label>Number</label>
                                            <input type="text" name="number" id="number" class="form-input">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" class="form-input">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-input">
                                             <label>Satus</label>
                                            <select class="form-select" name="status" id="status">
                                                <option>Chooice Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">In active</option>
                                            </select>
 
                                           </div>
                                        <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-outline-danger" @click="toggle">Close</button>
                                            <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Save</button>
                                        </div>
                                         </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    

                     
                    <!-- script -->
                    <script>
                        document.addEventListener("alpine:init", () => {
                            Alpine.data("modal", (initialOpenState = false) => ({
                                open: initialOpenState,
                    
                                toggle() {
                                    this.open = !this.open;
                                },
                            }));
                        });
                    </script>

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
        <label><input type="checkbox" class="colToggle" data-col="4" checked> Actions</label>
    </div>
    
    <table id="dataTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Name</th>
                <th onclick="sortTable(2)">Email</th>
                <th onclick="sortTable(3)">Role</th>
                <th onclick="sortTable(4)">Actions</th>
            </tr>
        </thead>
        <tbody id="readBody">
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

<script src="js/users.js"></script>