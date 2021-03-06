<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('temp/asset/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<!--slimscroll JavaScript -->
<script src="{{ asset('temp/asset/js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('temp/asset/js/waves.js') }}"></script>
<!--Counter js -->
<script src="{{ asset('temp/plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
<!--Morris JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/morrisjs/morris.js') }}"></script>
<!-- chartist chart -->
<script src="{{ asset('temp/plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
<script
    src="{{ asset('temp/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}">
</script>
<!-- Calendar JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/moment/moment.js') }}"></script>
<script src='{{ asset('temp/plugins/bower_components/calendar/dist/fullcalendar.min.js') }}'></script>
<script src="{{ asset('temp/plugins/bower_components/calendar/dist/cal-init.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('temp/asset/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('temp/asset/js/custom.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<!--         start - This is for export functionality only 
<!-- Select Script -->
<script src="{{ asset('temp/plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('temp/plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}"
    type="text/javascript"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="{{ asset('temp/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"
    type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('temp/plugins/bower_components/multiselect/js/jquery.multi-select.js') }}">
</script>

<script src="{{ asset('temp/plugins/bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
<!-- Clock Plugin JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/clockpicker/dist/bootstrap-clockpicker.js') }}"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}">
</script>
<script src="{{ asset('temp/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}">
</script>
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Date range Plugin JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('temp/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('temp/asset/js/cbpFWTabs.js') }}"></script>
<!-- Form Wizard JavaScript -->
<script src="{{ asset('temp/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js') }}"></script>
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script
    src="{{ asset('temp/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js') }}">
</script>
<script src="{{ asset('temp/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js') }}">
</script>
<!-- Sweet-Alert  -->
<script src="{{ asset('temp/plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"
    src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>

<script type="text/javascript">
    function getTableData(route, element, columns, params = null, order = null){
        var orderColumn = [[0, "asc"]];
        if(order){
            orderColumn = order;
        }
        $(element).empty();
        $('.load-content').show();
        $.ajax({
            url: route,
            data: params,
            success: function(res){
                $('.load-content').hide();
                if ($.fn.DataTable.isDataTable(element)) {
                    $(element).DataTable().clear().draw();
                    $(element).DataTable().destroy();
                }
                var tableCreated = $(element).DataTable({
                    data: res.data,
                    order: orderColumn,
                    columns: columns
                });
                $(element+" thead tr th").addClass('text-center');
            }
        });
    }

    function getBon(route, element, params = null){
        var jenis = (params.jenis == 1) ? "Pembelian" : "Penjualan";
        $(element).show();
        removeBon('.bon-transaksi');
        $(element+' .load-content').show();
        $.ajax({
            url: route,
            data: params,
            success: function(res){
                $(element+' .load-content').hide();
                $(element).append(res);
                $(element+' .jenis-transaksi-text').empty();
                $(element+' .jenis-transaksi-text').html(jenis);
                $('.seller').focus();
                $('#jenis').val(params.jenis);
                if(params.transaksi_id){
                    var route = "{{ route('transaksi.update', 'transaksi_id') }}";
                    route = route.replace('transaksi_id', params.transaksi_id);
                    $('#update-bon-transaksi').attr('action', route);
                }
            }
        });
    }

    function removeBon(bonEl){
        $(bonEl).remove();
    }

    function getAksiData(route, element, params = null){
        if(params){
            var jenis = (params.jenis == 1) ? "Pembelian" : "Penjualan";
        }
        $(element).empty();
        $('.modal .load-content').show();
        $.ajax({
            url: route,
            data: params,
            success: function(res){
                $('.modal .load-content').hide();
                $(element).append(res);
                $('.modal .jenis-transaksi-text').empty();
                $('.modal .jenis-transaksi-text').html(jenis);
            }
        });
    }

    function sellerExist(e){
        $('.seller-alert').empty();
        var jenis = $('#jenis').val();
        $.ajax({
            url: "{{ route('seller-exist') }}",
            data: {
                name: e.value,
                jenis: jenis
            },
            success: function(res){
                if(res.seller == 0){
                    var seller = (jenis == 1) ? "seller" : "buyer";
                    $('.seller-alert').append("Data "+seller+" belum ada di database, akan disimpan sebagai data "+seller+" baru");
                }
                $('#seller-id').val(res.sellerId);
                getHutangBySeller(res.sellerId);
            }
        });
        $('#nama-0').focus();
    }

    function nomorIndukExist(e){
        $('.nomor-karyawan-alert').empty();
        $('#tambah-karyawan').removeAttr('disabled');
        $.ajax({
            url: "{{ route('nomor-induk-exist') }}",
            data: { nomor_karyawan: e.value },
            success: function(res){
                if(res.karyawan > 0){
                    $('.nomor-karyawan-alert').append("Nomor induk karyawan sudah digunakan");
                    $('#tambah-karyawan').attr('disabled', 'disabled');
                }
            }
        });
    }

    function transaksiExist(e){
        $('.transaksi-alert').empty();
        $.ajax({
            url: "{{ route('transaksi-exist') }}",
            data: { kode_transaksi: e.value },
            success: function(res){
                if(res.transaksi.length == 0){
                    $('.transaksi-alert').append("Data transaksi tidak ditemukan di database");
                    $('.submit-retur-btn').attr('disabled', 'disabled');
                }else{
                    var transaksi_id = res.transaksi[0].id;
                    var jenis = res.transaksi[0].jenis;
                    var html = "<a class='aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-aksi='detail-transaksi' data-transaksi-id='"+transaksi_id+"' data-jenis='"+jenis+"' data-toggle='modal' data-target='#detailTransaksi'>Detail Transaksi</a>";
                    $('.transaksi-alert').append(html);
                    $('#transaksi-id').val(transaksi_id);
                    $('.submit-retur-btn').removeAttr('disabled');
                }
            }
        });
    }

    function getHutangBySeller(sellerId){
        var jenis = $('#jenis').val();
        $('#sisa-hutang, #sisa-hutang-temp, #sisa-dp, #sisa-dp-temp').val(0);
        $.ajax({
            url: "{{ route('get-hutang-by-seller') }}",
            data: { seller_id: sellerId, jenis: jenis },
            success: function(res){
                $('#sisa-hutang, #sisa-hutang-temp').val(res.hutang);
                $('#view-sisa-hutang').val(addCommas(res.hutang));

                $('#sisa-dp, #sisa-dp-temp').val(res.dp);
                $('#view-sisa-dp').val(addCommas(res.dp));
            }
        });
    }

    function updateSisaHutangDP(pembayaran, sisaTempEl, sisaEl, sisaViewEl){
        var sisaTemp = $(sisaTempEl).val();
        var sisa = $(sisaEl).val();
        sisa = sisaTemp - Number(pembayaran.replace(/\,/g,''));
        $(sisaEl).val(sisa);
        $(sisaViewEl).val(addCommas(sisa));
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function addNewRow(_this, spinner, target){
        var id = _this.getAttribute('id');
        $('#'+id).hide();
        $(spinner).show();
        var lastId = _this.getAttribute('last-id');
        var nextId = parseInt(lastId) + 1;
        $('#'+id).attr('last-id', nextId);
        $.ajax({
            url: "{{ route('add-row-transaksi') }}",
            data: {
                row_id: nextId
            },
            success: function(res){
                $(spinner).hide();
                $('#'+id).show();
                $(target).append(res);
            }
        });
    }

    function splitIdBaris(_this){
        var id = _this.split('-');
        var idBaris = id[1];
        return idBaris;
    }

    function updateTotal(element, result, view){
        var total = 0;
        var arr = $(element);
        for(var i=0;i<arr.length;i++){
            if(parseInt(arr[i].value))
            total += parseInt(arr[i].value);
        }
        $(result).val(parseInt(total));
        $(view).val(addCommas(parseInt(total)));
        return total;
    }

    function updateSisa(total, kas, tf, dp, hutang){
        var total = ($('#total-transaksi').val() == "") ? 0 : $('#total-transaksi').val();
        var kas = ($('#kas').val() == "") ? 0 : Number($('#kas').val().replace(/\,/g,''));
        var tf = ($('#transfer').val() == "") ? 0 : Number($('#transfer').val().replace(/\,/g,''));
        var dp = ($('#dp').val() == "") ? 0 : Number($('#dp').val().replace(/\,/g,''));
        var hutang = ($('#hutang').val() == "") ? 0 : Number($('#hutang').val().replace(/\,/g,''));
        var transaksi = ($('#transaksi').val() == "") ? 0 : Number($('#transaksi').val().replace(/\,/g,''));
        var sisa = ($('#sisa').val() == "") ? 0 : $('#sisa').val();
        var sisa = total - kas - tf - dp - hutang - transaksi;
        $('#sisa').val(sisa);
        $('#view-sisa').val(addCommas(sisa));
        return sisa;
    }

    function bonInputCheck(formButton, idBaris, obj, namaBarang, namaBarangAlertCounter)
    {
        if(obj != null && obj.length > 0) {
            if (namaBarangAlertCounter > 0) {
                namaBarangAlertCounter--;
            }
            if (namaBarangAlertCounter == 0){
                $('#buat-bon-button').removeAttr('disabled');
            }
            var barang_id = obj.data('id');
            $('#barang-id-'+idBaris).val(barang_id);
            $.ajax({
                url: "{{ route('stok-barang') }}",
                data: {
                    barang_id: barang_id
                },
                success: function(res){
                    $('#nama-barang-'+idBaris+'-alert').removeClass('nama-barang-salah');
                    $('#nama-barang-'+idBaris+'-alert').html("Stok saat ini: <strong>"+res.stok+" kg</strong>");
                }
            });
            $('#daftar-harga-'+idBaris).html("Lihat daftar harga");
            $('#daftar-harga-'+idBaris).attr('nama-barang', namaBarang);
        }else{
            namaBarangAlertCounter++;
            $('#buat-bon-button').attr('disabled', 'disabled');
            $('#nama-barang-'+idBaris+'-alert').html("Nama barang tidak ada");
            $('#nama-barang-'+idBaris+'-alert').addClass('nama-barang-salah');
            $('#daftar-harga-'+idBaris).empty();
        }

        return namaBarangAlertCounter;
    }

    function addCommas(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    $('body').on('keydown', 'input[type=number]', function(e) {
        if (e.which === 38 || e.which === 40) {
            e.preventDefault();
        }
    });

    $('body').on('keyup', 'input', function(e) {
        if(e.which == 39) {
            $(this).closest('td').next().find('input').focus();
        } else if(e.which == 37) {
            $(this).closest('td').prev().find('input').focus();
        } else if(e.which == 40) {
            e.preventDefault();
            $(this).closest('tr').next().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
        } else if(e.which == 38) {
            e.preventDefault();
            $(this).closest('tr').prev().find('td:eq('+$(this).closest('td').index()+')').find('input').focus();
        }
    });
</script>
