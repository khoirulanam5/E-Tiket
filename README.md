# Sistem Pemesanan Tiket & Penyewaan Bus

Sistem pemesanan tiket dan penyewaan bus lengkap dengan fitur notifikasi WhatsApp, perhitungan **SERVQUAL** untuk mengukur tingkat kepuasan pelanggan, serta modul administrasi yang lengkap. Dibangun menggunakan **CodeIgniter 3**, **MySQL**, serta frontend **HTML**, **CSS**, **JavaScript**, **Bootstrap**, dan landing page modern.

---

## 🚀 Fitur Utama

### 🎫 Pemesanan Tiket & Penyewaan Bus

* Pemesanan tiket perjalanan
* Penyewaan bus untuk berbagai kebutuhan (wisata, rombongan, event)
* Sistem penjadwalan bus & sopir
* Manajemen armada bus

### 📢 Notifikasi WhatsApp

* Notifikasi pemesanan berhasil
* Notifikasi perubahan jadwal
* Notifikasi pembayaran
* Notifikasi informasi keberangkatan

### 📈 Analisis Kepuasan Pelanggan dengan **Metode SERVQUAL**

* Pengukuran kualitas layanan berdasarkan lima dimensi:

  * **Tangibles** (bukti fisik)
  * **Reliability** (keandalan)
  * **Responsiveness** (ketanggapan)
  * **Assurance** (jaminan)
  * **Empathy** (empati)
* Kuesioner pelanggan
* Perhitungan otomatis gap (harapan vs persepsi)
* Laporan hasil analisis SERVQUAL

### 👥 Role Pengguna

* **Admin** – Mengelola seluruh data & konfigurasi sistem
* **Sekretaris** – Mengelola jadwal, pemesanan, dan komunikasi pelanggan
* **Bendahara** – Mengelola pembayaran, keuangan, dan laporan transaksi
* **Pemilik** – Melihat laporan bisnis, performa layanan & hasil SERVQUAL
* **Pelanggan** – Pemesanan tiket, penyewaan bus, melihat status & mengisi kepuasan layanan

### 📊 Laporan Lengkap

* Laporan transaksi pemesanan
* Laporan keuangan (pemasukan, pengeluaran)
* Laporan penggunaan armada
* Laporan hasil SERVQUAL

### 🌐 Landing Page Modern

* Tampilan profesional
* Informasi layanan
* Galeri bus
* Harga paket & tujuan
* Testimoni pelanggan

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** CodeIgniter 3
* **Database:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
* **Notification:** WhatsApp API / Gateway
* **Analysis:** Metode SERVQUAL

---

## 📂 Struktur Folder (Contoh)

```
application/
│── controllers/
│── models/
│── views/
│── libraries/
public/
│── assets/
│   ├── css/
│   ├── js/
│   ├── img/
landing_page/
│── index.html
│── assets/
database/
│── schema.sql
README.md
```

---

## 🔧 Cara Instalasi

1. Clone repository:

   ```bash
   git clone <repo-url>
   ```

2. Masuk ke folder project:

   ```bash
   cd tiket-bus
   ```

3. Import database:

   * Buat database baru
   * Import file `schema.sql`

4. Konfigurasi CodeIgniter:

   * Atur `base_url` di `application/config/config.php`
   * Atur konfigurasi MySQL di `application/config/database.php`

5. Konfigurasi API WhatsApp & variabel sistem lainnya.

6. Jalankan melalui browser:

   ```
   http://localhost/tiket-bus
   ```

---

## 📸 Screenshot (Opsional)

Tambahkan screenshot sistem Anda:

```
![Landing Page](assets/img/landing.png)
![Dashboard](assets/img/dashboard.png)
![Pemesanan](assets/img/order.png)
![Laporan SERVQUAL](assets/img/servqual.png)
```

---

## 📞 Contact

Silakan lihat halaman **Contact** dalam sistem untuk informasi lebih lanjut.

---

## 📄 License

Sesuaikan lisensi (Open source / Private).

---
