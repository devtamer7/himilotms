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
                            <button type="button" class="btn btn-primary" @click="toggle"><i class="fas fa-plus"></i>&nbsp;Create Permession</button>
                        </div>
                    
                        <!-- modal -->
                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
                            <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
                                <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-8 w-full max-w-lg">
                                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                                        <div class="font-bold text-lg">New Permession</div>
                                       
                                    </div>
                                    <div class="p-5">
                                       <form id="permessionForm" class="form-group">
                                        <label class="mb-2">Display Name <span class="text-danger">*</span></label>
                                        <input name="dName" type="text" class="form-input">
                                        <label class="my-2">Permession <strong>(Don't Use Space, Use _ )</strong><span class="text-danger"> *</span> </label>
                                        <input name="permession" type="text" class="form-input">
                                          <label class="my-2">Description <strong>(Optional)</strong>	</label>
                                        <textarea name="description" type="text" class="form-textarea"></textarea>
                                        <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
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
        <label><input type="checkbox" class="colToggle" data-col="1" checked> Permession</label>
        <label><input type="checkbox" class="colToggle" data-col="2" checked> Display Name</label>
        <label><input type="checkbox" class="colToggle" data-col="3" checked> Create Date</label>
        <label><input type="checkbox" class="colToggle" data-col="4" checked> Actions</label>
    </div>
    
    <table id="dataTable">
        <thead>
            <tr>
                <th onclick="sortTable(0)">ID</th>
                <th onclick="sortTable(1)">Permession</th>
                <th onclick="sortTable(2)">Display Name</th>
                <th onclick="sortTable(3)">Create Date</th>
                <th onclick="sortTable(4)">Actions</th>
                
            </tr>
        </thead>
        <tbody id="permissionTableBody">
            <!-- JS will populate rows -->
        </tbody>
    </table>
    
    <div class="pagination" id="pagination"></div>
</div>
<!-- Edit Permission Modal -->
<div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" id="editModal">
    <div class="flex items-start justify-center min-h-screen px-4">
        <div class="panel border-0 p-0 rounded-lg overflow-hidden my-8 w-full max-w-lg bg-white">
            <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                <div class="font-bold text-lg">Edit Permission</div>
            </div>
            <div class="p-5">
                <form id="permessionEditForm">
                    <input type="hidden" name="id" id="editId">
                    <label class="mb-2">Display Name <span class="text-danger">*</span></label>
                    <input name="dName" id="editDName" type="text" class="form-input">

                    <label class="my-2">Permission <span class="text-danger">*</span></label>
                    <input name="permession" id="editPermession" type="text" class="form-input">

                    <label class="my-2">Description</label>
                    <textarea name="description" id="editDescription" class="form-textarea"></textarea>

                    <div class="flex justify-end items-center mt-8">
                                            <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                        <button type="submit" class="btn btn-primary ltr:ml-4 rtl:mr-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


  </div>
</div>
<?php
require_once "includes/footer.php";
require_once "includes/dataTablejs.php";
?>
<script src="js/permessions.js"></script>