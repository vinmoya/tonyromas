@extends('layouts.template-main')

@section('content')

	<div class="ks-dashboard-tabbed-sidebar">
        <div class="ks-dashboard-tabbed-sidebar-widgets">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card ks-widget-payment-simple-amount-item ks-orange">
                        <div class="payment-simple-amount-item-icon-block">
                            <span class="la la-barcode ks-icon"></span>
                        </div>

                        <div class="payment-simple-amount-item-body">
                            <div class="payment-simple-amount-item-amount">
                                <span class="ks-amount">{{ $countNA }}</span>
                            </div>
                            <div class="payment-simple-amount-item-description">
                                Códigos sin Activar
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card ks-widget-payment-simple-amount-item ks-purple">
                        <div class="payment-simple-amount-item-icon-block">
                            <span class="la la-code ks-icon"></span>
                        </div>

                        <div class="payment-simple-amount-item-body">
                            <div class="payment-simple-amount-item-amount">
                                <span class="ks-amount">{{ $countAC }}</span>
                            </div>
                            <div class="payment-simple-amount-item-description">
                                Códigos Activos
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card ks-widget-payment-simple-amount-item ks-green">
                        <div class="payment-simple-amount-item-icon-block">
                            <span class="la la-check-circle ks-icon"></span>
                        </div>

                        <div class="payment-simple-amount-item-body">
                            <div class="payment-simple-amount-item-amount">
                                <span class="ks-amount">{{ $countRC }}</span>
                            </div>
                            <div class="payment-simple-amount-item-description">
                                Códigos Canjeados
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card ks-widget-payment-simple-amount-item ks-pink">
                        <div class="payment-simple-amount-item-icon-block">
                            <span class="la la-times-circle-o ks-icon"></span>
                        </div>

                        <div class="payment-simple-amount-item-body">
                            <div class="payment-simple-amount-item-amount">
                                <span class="ks-amount">{{ $countCC }}</span>
                            </div>
                            <div class="payment-simple-amount-item-description">
                                Códigos Anulados 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="row">
	    <div class="col-sm-4">
            <div class="card ks-card-widget ks-widget-payment-total-amount ks-purple-light">
                <h5 class="card-header">
                    Códigos Activados por Sistema
                </h5>
                <div class="card-block">
                    <div class="ks-payment-total-amount-item-icon-block">
                        <span class="ks-icon-combo-chart ks-icon"></span>
                    </div>

                    <div class="ks-payment-total-amount-item-body">
                        <div class="ks-payment-total-amount-item-amount">
                            <span class="ks-amount">{{ $countCR }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
	        <div class="card ks-card-widget ks-widget-payment-total-amount ks-purple-light">
	            <h5 class="card-header">
	                Códigos Activados por Restaurantes
	            </h5>
	            <div class="card-block">
	                <div class="ks-payment-total-amount-item-icon-block">
	                    <span class="ks-icon-combo-chart ks-icon"></span>
	                </div>

	                <div class="ks-payment-total-amount-item-body">
	                    <div class="ks-payment-total-amount-item-amount">
	                        <span class="ks-amount">{{ $countAR }}</span>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="card ks-card-widget ks-widget-payment-total-amount ks-green-light">
	            <h5 class="card-header">
	                Códigos Canjeados por Restaurantes

	            </h5>
	            <div class="card-block">
	                <div class="ks-payment-total-amount-item-icon-block">
	                    <span class="la la-pie-chart ks-icon"></span>
	                </div>

	                <div class="ks-payment-total-amount-item-body">
	                    <div class="ks-payment-total-amount-item-amount">
	                        <span class="ks-amount">{{ $countCCR }}</span>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
		
@endsection
