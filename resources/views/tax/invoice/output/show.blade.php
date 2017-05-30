@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.output.show.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.output.show.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.output.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('show_tax_invoice_output', $tax->hId()) !!}
@endsection

@section('content')
    <div id="taxVue">
        <form id="taxForm" class="form-horizontal">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Informasi Transaksi PPN</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputGSTTranType" class="col-sm-4 control-label">Jenis Transaksi PPN</label>
                                    <div class="col-sm-8">
                                        <select id="inputGSTTranType" name="gst_transaction_type" class="form-control">
                                            <option v-bind:value="defaultGSTTranType.code">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="vtt of gstTranTypeDDL" v-bind:value="vtt.code">@{{ vtt.description }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTransDoc" class="col-sm-4 control-label">Dokumen Transaksi</label>
                                    <div class="col-sm-8">
                                        <select id="inputTransDoc" name="transaction_doc" class="form-control">
                                            <option v-bind:value="defaultTranDoc.code">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="td of tranDocDDL" v-bind:value="td.code">@{{ td.description }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTranDet" class="col-sm-4 control-label">Detail Transaksi PPN</label>
                                    <div class="col-sm-8">
                                        <select id="inputTranDet" name="transaction_detail" class="form-control">
                                            <option v-bind:value="defaultTranDetail.code">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="td of tranDetailDDL" v-bind:value="td.code">@{{ td.description }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputDateOfTaxDoc" class="col-sm-4 control-label">Tanggal Dokumen Pajak</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <vue-datetimepicker id="inputDateOfTaxDoc" name="tax_doc_date" format="DD-MM-YYYY" @change="changeTaxPeriod"></vue-datetimepicker>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTaxPeriod" class="col-sm-4 control-label">Masa Pajak</label>
                                    <div class="col-sm-8">
                                        <input id="inputTaxPeriod" name="tax_period" type="text" class="form-control" v-bind:value="taxPeriod" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputInvoiceNo" class="col-sm-4 control-label">Nomor Seri Faktur Pajak</label>
                                    <div class="col-sm-8">
                                        <input id="inputInvoiceNo" name="invoice_no" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputReference" class="col-sm-4 control-label">Referensi</label>
                                    <div class="col-sm-8">
                                        <textarea id="inputReference" name="reference" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pengusahan Kena Pajak</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputTaxIDNo" class="col-sm-2 control-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input id="inputTaxIDNo" name="tax_id_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input id="inputName" name="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="inputAddress" name="address" class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Lawan Transaksi</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputOpponentTaxIDNo" class="col-sm-2 control-label">NPWP</label>
                                <div class="col-sm-10">
                                    <input id="inputOpponentTaxIDNo" name="opponent_tax_id_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputOpponentName" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input id="inputOpponentName" name="opponent_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputOpponentAddress" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="inputOpponentAddress" name="opponent_address" class="form-control" rows="6"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Detail Transaksi</h3>
                            <button type="button" class="btn btn-primary btn-xs pull-right" v-on:click="insertTransaction()"><span class="fa fa-plus fa-fw"/></button>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="detailTransactionListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Nama Barang Kena Pajak / Jasa Kena Pajak</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Potongan Harga</th>
                                            <th class="text-center">Jumlah Barang</th>
                                            <th class="text-center">PPnBM</th>
                                            <th class="text-center">Harga Total</th>
                                            <th >&nbsp</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(tran, tranIndex) in taxOutput.transactions">
                                            <td>
                                                <input name="tran_name[]" type="text" class="form-control" v-model="tran.name">
                                            </td>
                                            <td>
                                                <input name="tran_price[]" type="text" class="form-control text-right" v-model="tran.price"/>
                                            </td>
                                            <td>
                                                <input name="tran_discount[]" type="text" class="form-control text-right" v-model="tran.discount"/>
                                            </td>
                                            <td>
                                                <input name="tran_qty[]" type="text" class="form-control text-right" v-model="tran.qty"/>
                                            </td>
                                            <td>
                                                <input name="tran_luxury_tax[]" type="text" class="form-control text-right" v-model="tran.luxuryTax"/>
                                            </td>
                                            <td class="text-right valign-middle">
                                                <input name="tran_gst[]" type="hidden" v-model="tran.gst">
                                                @{{ calcSubtotalPrice(tranIndex, tran.price, tran.discount, tran.qty) }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-md"><span class="fa fa-minus" v-on:click="removeTransaction(tranIndex)"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="transactionsTotalListTable" class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="text-left">Harga Jual / Penggantian</td>
                                            <td class="text-right">
                                                <input name="selling_price" type="hidden" v-bind:value="taxOutput.totalSellingPrice"/>
                                                <span class="control-label-normal">@{{ taxOutput.totalSellingPriceText }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Dikurangi Potongan Harga</td>
                                            <td class="text-right">
                                                <input name="discount" type="hidden" v-bind:value="taxOutput.totalDiscount"/>
                                                <span class="control-label-normal">@{{ taxOutput.totalDiscountText }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Dasar Pengenaan Pajak</td>
                                            <td class="text-right">
                                                <input name="tax_base" type="hidden" v-bind:value="taxOutput.totalTaxBase"/>
                                                <span class="control-label-normal">@{{ taxOutput.totalTaxBaseText }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">PPN = 10% x Dasar Pengenaan Pajak</td>
                                            <td class="text-right">
                                                <input name="gst" type="hidden" v-bind:value="taxOutput.totalGST"/>
                                                <span class="control-label-normal">@{{ taxOutput.totalGSTText }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">Total PPnBM (Pajak Penjualan Barang Mewah)</td>
                                            <td class="text-right">
                                                <input name="luxury_tax" type="hidden" v-bind:value="taxOutput.totalLuxuryTax"/>
                                                <span class="control-label-normal">@{{ taxOutput.totalLuxuryTaxText }}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="button" class="btn btn-primary pull-right" v-on:click="validateBeforeSubmit('submit')">@lang('buttons.submit_button')</button>
                        <button id="cancelButton" type="button" class="cancelButton btn btn-primary pull-right" href="{{ route('db.tax.invoice.output.index') }}">@lang('buttons.cancel_button')</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">

        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        Vue.component('vue-datetimepicker', {
            template: "<input type='text' v-bind:id='id' v-bind:name='name' class='form-control' v-bind:format='format' v-model='value'>",
            props: ['id', 'name', 'format'],
            data: function() {
                return {
                    value: ''
                };
            },
            mounted: function() {
                var vm = this;

                if (this.format == undefined) this.format = 'DD-MM-YYYY';
                if (this.readonly == undefined) this.readonly = 'false';

                $(this.$el).datetimepicker({
                    format: this.format,
                    defaultDate: this.value == '' ? moment():moment(this.value),
                    showTodayButton: true,
                    showClose: true
                })
                    .on('dp.change', function(e) {
                        vm.$emit('change', e.date);
                    });

            },
            destroyed: function() {
                $(this.$el).data("DateTimePicker").destroy();
            }
        });

        var poApp = new Vue({
            el: '#taxVue',
            data: {
                gstTranTypeDDL: JSON.parse('{!! htmlspecialchars_decode($gstTranTypeDDL) !!}'),
                tranDocDDL: JSON.parse('{!! htmlspecialchars_decode($tranDocDDL) !!}'),
                tranDetailDDL: JSON.parse('{!! htmlspecialchars_decode($tranDetailDDL) !!}'),
                taxPeriod: moment().format('MM/YYYY'),
                taxOutput: {
                    transactions: [],
                    totalSellingPrice: 0,
                    totalSellingPriceText: '',
                    totalDiscount: 0,
                    totalDiscountText: '',
                    totalTaxBase: 0,
                    totalTaxBaseText: '',
                    totalGST: 0,
                    totalGSTText: '',
                    totalLuxuryTax: 0,
                    totalLuxuryTaxText: '',
                }
            },
            methods: {
                validateBeforeSubmit: function(type) {
                    this.$validator.validateAll().then(function(result) {
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.tax.invoice.output.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#taxForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.tax.invoice.output.index') }}';
                            });
                    }).catch(function() {

                    });
                },
                changeTaxPeriod: function(e) {
                    this.taxPeriod = moment(e).format('MM/YYYY');
                },
                insertTransaction: function() {
                    var vm = this;
                    vm.taxOutput.transactions.push({
                        name: '',
                        price: 0,
                        discount: 0,
                        gst: 0,
                        luxuryTax: 0,
                        qty: 0,
                        subTotal: 0,
                    });
                },
                removeTransaction: function (index) {
                    var vm = this;
                    vm.taxOutput.transactions.splice(index, 1);
                    this.calcTax();
                },
                calcSubtotalPrice: function(index, price, discount, qty) {
                    subtotal = (price - discount) * qty;
                    this.taxOutput.transactions[index].subTotal = subtotal;
                    this.calcTax();
                    return numeral(subtotal).format();
                },
                calcTax: function() {
                    var totalSellingPrice = 0;
                    var totalDiscount = 0;
                    var totalTaxBase = 0;
                    var totalGST = 0;
                    var totalLuxuryTax = 0;
                    this.taxOutput.transactions.forEach(function(tran) {
                        tran.gst = 10 / 100 * tran.price;
                        totalSellingPrice += tran.price * tran.qty;
                        totalDiscount += tran.discount * tran.qty;
                        totalLuxuryTax += tran.luxuryTax * tran.qty;
                    });
                    totalTaxBase = totalSellingPrice - totalDiscount;
                    totalGST = 10 / 100 * totalTaxBase;
                    this.taxOutput.totalSellingPrice = totalSellingPrice;
                    this.taxOutput.totalSellingPriceText = numeral(totalSellingPrice).format();
                    this.taxOutput.totalDiscount = totalDiscount;
                    this.taxOutput.totalDiscountText = numeral(totalDiscount).format();
                    this.taxOutput.totalTaxBase = totalTaxBase;
                    this.taxOutput.totalTaxBaseText = numeral(totalTaxBase).format();
                    this.taxOutput.totalGST = totalGST;
                    this.taxOutput.totalGSTText = numeral(totalGST).format();
                    this.taxOutput.totalLuxuryTax = totalLuxuryTax;
                    this.taxOutput.totalLuxuryTaxText = numeral(totalLuxuryTax).format();
                }
            },
            computed: {
                defaultGSTTranType: function(){
                    return {
                        code: ''
                    };
                },
                defaultTranDoc: function(){
                    return {
                        code: ''
                    };
                },
                defaultTranDetail: function(){
                    return {
                        code: ''
                    };
                },
            }
        });

    </script>
@endsection
