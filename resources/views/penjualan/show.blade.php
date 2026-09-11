<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Transaksi #3</title>
  <!-- Menggunakan Font Inter agar tampilan lebih bersih -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- FontAwesome untuk ikon tombol -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
    }

    body {
      background-color: #f8fafc;
      color: #334155;
      padding: 40px 20px;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
    }

    /* Header & Action Buttons */
    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0f172a;
    }

    .action-buttons {
      display: flex;
      gap: 12px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 16px;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      border: none;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .btn-secondary {
      background-color: #ffffff;
      color: #475569;
      border: 1px solid #cbd5e1;
    }

    .btn-secondary:hover {
      background-color: #f1f5f9;
      color: #0f172a;
    }

    .btn-primary {
      background-color: #2563eb;
      color: #ffffff;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    /* Card Informasi Transaksi */
    .card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 24px;
      margin-bottom: 24px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .info-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .info-label {
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #64748b;
      font-weight: 600;
    }

    .info-value {
      font-size: 0.95rem;
      font-weight: 600;
      color: #1e293b;
    }

    /* Badge Status */
    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      width: fit-content;
    }

    .badge-success {
      background-color: #dcfce7;
      color: #15803d;
    }

    /* Tabel Barang */
    .section-title {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 12px;
    }

    .table-container {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th {
      background-color: #f8fafc;
      padding: 12px 16px;
      font-size: 0.75rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: #64748b;
      font-weight: 600;
      border-bottom: 1px solid #e2e8f0;
    }

    td {
      padding: 16px;
      font-size: 0.875rem;
      border-bottom: 1px solid #f1f5f9;
      color: #334155;
    }

    tr:last-child td {
      border-bottom: none;
    }

    .text-center { text-align: center; }
    .text-right { text-align: right; }

    /* Custom CSS khusus untuk Mode Cetak (Print) */
    @media print {
      body {
        background-color: #ffffff;
        padding: 0;
      }

      .no-print {
        display: none !important;
      }

      .card, .table-container {
        border: 1px solid #ccc;
        box-shadow: none;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <!-- Header Halaman -->
    <div class="page-header">
      <h1 class="page-title">Detail Transaksi #3</h1>
      <div class="action-buttons no-print">
        <a href="#" class="btn btn-secondary">
          <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-primary">
          <i class="fa-solid fa-print"></i> Cetak Struk
        </button>
      </div>
    </div>

    <!-- Info Detail Transaksi -->
    <div class="card">
      <div class="info-grid">
        <div class="info-item">
          <span class="info-label">Tanggal Transaksi</span>
          <span class="info-value">11-09-2026 13:53:48</span>
        </div>
        <div class="info-item">
          <span class="info-label">Kasir</span>
          <span class="info-value">Admin</span>
        </div>
        <div class="info-item">
          <span class="info-label">Status</span>
          <div>
            <span class="badge badge-success">COMPLETED</span>
          </div>
        </div>
        <div class="info-item">
          <span class="info-label">Metode Pembayaran</span>
          <span class="info-value">CASH</span>
        </div>
        <div class="info-item">
          <span class="info-label">Total Pembayaran</span>
          <span class="info-value" style="color: #2563eb;">Rp 14.000</span>
        </div>
      </div>
    </div>

    <!-- Tabel Daftar Barang -->
    <h2 class="section-title">Daftar Barang</h2>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Produk</th>
            <th class="text-center">Kuantitas</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">1</td>
            <td><strong>Teh Pucuk</strong></td>
            <td class="text-center">4</td>
            <td class="text-right">Rp 3.500</td>
            <td class="text-right"><strong>Rp 14.000</strong></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>