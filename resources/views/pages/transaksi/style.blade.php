<style type="text/css">
    .tab-list {
        display: flex;
    }
    .tab {
        width: 50%;
        color: #000;
        background: lightgrey;
        text-align: center;
        cursor: pointer;
        padding: 10px 0;
        font-weight: 450;
    }
    .tab-active {
        color: #fff;
        background: #4caf50;
    }
    .transaksi-button, .transaksi-box {
        margin: 20px 0;
    }
    .transaksi-box {
        display: none;
    }
    #tabel-barang-pembelian span {
        color: blue;
        cursor: pointer;
        display: none;
        font-style: italic;
    }
    .nama-barang-alert {
        color: red !important;
        font-style: italic;
        display: none;
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
        .tab-list {
            display: block;
        }
        .tab {
            width: 100%;
        }
        #pembelian {
            margin-bottom: 10px;
        }
        input {
            min-width: 100px;
        }
    }
</style>