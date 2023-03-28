function searchTable() {
    // Deklarasi variabel
    let input, filter, table, tr, td, i, txtValue;
    input = document.querySelector('input[type="text"]');
    filter = input.value.toUpperCase();
    table = document.querySelector('#table');
    tr = table.getElementsByTagName('tr');
  
    // Looping melalui semua baris tabel dan menyembunyikan yang tidak cocok dengan kata kunci pencarian
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName('td');
      for (let j = 0; j < td.length; j++) {
        let cell = td[j];
        if (cell) {
          txtValue = cell.textContent || cell.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
            break;
          } else {
            tr[i].style.display = 'none';
          }
        }
      }
    }
  }

  var table = document.getElementById('tableBody');
  var rows = table.rows;
  var rowsPerPage = 5; // Ubah jumlah baris per halaman di sini
  var currentPage = 1;
  var totalPages = Math.ceil(rows.length / rowsPerPage);
  
  showPage(1); // Menampilkan halaman pertama
  
  function showPage(page) {
    currentPage = page;
    var start = (page - 1) * rowsPerPage;
    var end = start + rowsPerPage;
    for (var i = 0; i < rows.length; i++) {
      if (i >= start && i < end) {
        rows[i].style.display = '';
      } else {
        rows[i].style.display = 'none';
      }
    }
    updateButtons();
  }
  
  function updateButtons() {
    var prevButton = document.getElementById('prevButton');
    var nextButton = document.getElementById('nextButton');
    if (currentPage === 1) {
      prevButton.style.display = 'none';
    } else {
      prevButton.style.display = '';
    }
    if (currentPage === totalPages || totalPages === 0) { // tambahkan kondisi totalPages === 0
      nextButton.style.display = 'none';
    } else {
      nextButton.style.display = '';
    }
  }
  
  
  function nextPage() {
    if (currentPage < totalPages) {
      showPage(currentPage + 1);
    }
  }
  
  function prevPage() {
    if (currentPage > 1) {
      showPage(currentPage - 1);
    }
  }
  

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  var rowIndex = row.rowIndex - 1; // Mengurangi 1 karena header tabel tidak dihitung
  var photoFilename = row.cells[6].querySelector('img').src.split('/').pop(); // Mengambil nama file foto dari kolom terakhir
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          // Hapus baris dari tabel
          document.getElementById('table').deleteRow(row.rowIndex);
      }
  };

  // Kirim indeks baris dan nama file foto ke file PHP yang akan menghapus data
  xmlhttp.open('POST', 'delete_data.php', true);
  xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xmlhttp.send('index=' + rowIndex + '&photo=' + photoFilename);
}
