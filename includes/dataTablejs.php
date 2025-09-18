
<!-- Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
// Data
let data = [];
let currentPage = 1;
let rowsPerPage = 10;
let filteredData = [...data];

// Functions
function renderTable(){
    const tbody = document.getElementById('tableBody');
    tbody.innerHTML = "";
    const start = (currentPage-1)*rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start,end);
    pageData.forEach(row=>{
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${row.id}</td><td>${row.name}</td><td>${row.email}</td><td>${row.role}</td>`;
        tbody.appendChild(tr);
    });
    renderPagination();
}

function renderPagination(){
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = "";
    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    for(let i=1;i<=totalPages;i++){
        const btn = document.createElement('button');
        btn.textContent = i;
        if(i===currentPage) btn.classList.add('active');
        btn.onclick = ()=>{currentPage=i; renderTable();}
        pagination.appendChild(btn);
    }
}

// Search
document.getElementById('searchInput').addEventListener('input',e=>{
    const search = e.target.value.toLowerCase();
    filteredData = data.filter(row=>Object.values(row).some(val=>val.toString().toLowerCase().includes(search)));
    currentPage=1;
    renderTable();
});

// Entries
document.getElementById('entriesSelect').addEventListener('change',e=>{
    rowsPerPage=parseInt(e.target.value);
    currentPage=1;
    renderTable();
});

// Column chooser
document.querySelectorAll('.colToggle').forEach(cb=>{
    cb.addEventListener('change',e=>{
        const col = parseInt(e.target.dataset.col);
        document.querySelectorAll('#dataTable tr').forEach(tr=>{
            if(tr.children[col]) tr.children[col].style.display = e.target.checked?'':'none';
        });
    });
});

// Sorting
let sortDirection = true;
function sortTable(colIndex){
    filteredData.sort((a,b)=>{
        const key = Object.keys(a)[colIndex];
        if(a[key]<b[key]) return sortDirection?-1:1;
        if(a[key]>b[key]) return sortDirection?1:-1;
        return 0;
    });
    sortDirection = !sortDirection;
    renderTable();
}

// Export CSV
function exportCSV(){
    let csv = Object.keys(data[0] || {}).join(",") + "\n";
    filteredData.forEach(row=>{ csv += Object.values(row).join(",")+"\n"; });
    const blob = new Blob([csv],{type:'text/csv'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'table.csv';
    a.click();
}

// Export JSON
function exportJSON(){
    const blob = new Blob([JSON.stringify(filteredData,null,2)],{type:'application/json'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'table.json';
    a.click();
}

// Export PDF
function exportPDF(){
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    let rows = filteredData.map(r=>[r.id,r.name,r.email,r.role]);
    doc.autoTable({ head:[["ID","Name","Email","Role"]], body:rows });
    doc.save('table.pdf');
}

// Print
function printTable(){
    const div = document.createElement('div');
    div.innerHTML = document.getElementById('dataTable').outerHTML;
    const newWin = window.open('');
    newWin.document.write('<html><head><title>Print Table</title></head><body>'+div.innerHTML+'</body></html>');
    newWin.document.close();
    newWin.print();
}

// Import Excel
document.getElementById('importExcel').addEventListener('change', e=>{
    const file = e.target.files[0];
    const reader = new FileReader();
    reader.onload = (evt)=>{
        const bstr = evt.target.result;
        const wb = XLSX.read(bstr,{type:'binary'});
        const wsname = wb.SheetNames[0];
        const ws = wb.Sheets[wsname];
        const json = XLSX.utils.sheet_to_json(ws,{header:["id","name","email","role"], defval:""});
        data = json;
        filteredData = [...data];
        currentPage=1;
        renderTable();
    }
    reader.readAsBinaryString(file);
});

// Initial dummy data
data = Array.from({length:50},(_,i)=>({id:i+1,name:`User ${i+1}`,email:`user${i+1}@example.com`,role:["Admin","Editor","User"][i%3]}));
filteredData = [...data];
renderTable();



alert(theme);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>