<style>
:root {
  --bg-color: #f4f7fc;
  --text-color: #000;
  --table-bg: #fff;
  --table-head: #f0f0f0;
  --hover-bg: #f9f9f9;
  --btn-bg: #28a745;
  --btn-hover: #218838;
  --primary: #007bff;
  --primary-hover: #0056b3;
}

body {
  font-family: Arial, sans-serif;
  padding: 20px;
  background: var(--bg-color);
  color: var(--text-color);
  transition: all 0.3s ease;
}

.table-container {
  background: var(--table-bg);
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  overflow-x: auto;
  transition: all 0.3s ease;
}

h2 { text-align: center; margin-bottom: 20px; }
.controls { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 10px; }
.controls select, .controls input, .controls button {
  padding: 5px 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  outline: none;
  cursor: pointer;
}
table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
th { cursor: pointer; background: var(--table-head); }
tr:hover { background: var(--hover-bg); }

.pagination { display: flex; justify-content: center; gap: 5px; margin-top: 10px; }
.pagination button { padding: 5px 10px; border: 1px solid #ccc; background: #fff; border-radius: 6px; cursor: pointer; }
.pagination button.active { background: var(--primary); color: #fff; border-color: var(--primary); }
.column-chooser label { margin-right: 10px; }
.export-buttons button {
  background: var(--btn-bg);
  color: #fff;
  border: none;
  cursor: pointer;
  margin-right: 5px;
}
.export-buttons button:hover { background: var(--btn-hover); }
.import-btn { background: var(--primary); color:#fff; border:none; margin-right:5px; }
.import-btn:hover { background: var(--primary-hover); }
.column-chooser { display: flex; }

/* 🌙 Dark Theme */
body.dark {
  --bg-color: #050818;
  --text-color: #f0f0f0;
  --table-bg: #0f1220;
  --table-head: #1a1e2e;
  --hover-bg: #1e2233;
  --btn-bg: #2ecc71;
  --btn-hover: #27ae60;
  --primary: #3498db;
  --primary-hover: #2980b9;
}

</style>
