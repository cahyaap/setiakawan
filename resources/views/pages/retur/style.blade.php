<style type="text/css">
    .transaksi-box, .transaksi-button-list button {
        margin-bottom: 20px;
    }
    .transaksi-box {
        display: none;
    }
    #tabel-barang-transaksi tbody span, .transaksi-alert, .transaksi-alert a {
        color: blue;
        cursor: pointer;
        font-style: italic;
        font-size: 14px;
    }
    .nama-barang-salah, .transaksi-alert {
        color: red !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }

    @media (max-width: 768px) {
        input {
            min-width: 100px;
        }
    }
</style>