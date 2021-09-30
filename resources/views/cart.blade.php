@extends('layout/app')

@section('content')
<div class="container">
  @if (Session::has('success'))
  <div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
  </div>
  @endif
  <h1 class="text-center">Cart Page</h1>
  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="50%">Product</th>
          <th width="10%">Prize</th>
          <th width="8%">Quantity</th>
          <th width="22%">Total</th>
          <th width="10%"></th>
        </tr>
      </thead>
      <tbody>
        @php $total=0; @endphp
        @if(session('cart'))
        @foreach(session('cart') as $id=>$product)

        @php
        $subtotal=$product['prize'] * $product['quantity'];
        $total += $subtotal;
        @endphp
        <tr>
          <td><img src="{{ $product['image'] }}" alt="" width="40">
            <span>{{$product['name']}}</span>
          </td>
          <td>${{ $product['prize'] }}</td>
          <td>{{ $product['quantity'] }}</td>
          <td>{{ $subtotal }}</td>
          <td>
            <a href="/remove/{{ $id }}" class="btn btn-danger btn-sm">X</a>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
      <tfoot>
        <tr>
          <td><a href="/" class="btn btn-warning">continue shopping</a>


            <!-- <input type="hidden" name="amount" value="{{ $total }}"> -->
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success">Procceed to Pay</button>


          </td>
          <td colspan="2"></td>
          <td><strong>Total {{ $total }}</strong></td>
        </tr>
      </tfoot>
    </table>

  </div>
</div>



<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="panel-body">

          <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            <div class='form-row row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Name on Card</label> <input class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row row'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
              </div>
            </div>
            <div class='form-row row'>
              <div class='col-xs-12 col-md-4 form-group cvc required'>
                <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
              </div>
              <div class='col-xs-12 col-md-4 form-group expiration required'>
                <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-xs-12 col-md-4 form-group expiration required'>
                <label class='control-label'>Expiration Year</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
              </div>
            </div>
            <div class='form-row row'>
              <div class='col-md-12 error form-group hide'>
                <div class='alert-danger alert'>
                </div>
              </div>
            </div>
            <div class="invisible"> <input type="hide" value="{{ $total }}" name="amount"></div>

            <div class="row">
              <div class="col-xs-12">
                <button class="btn btn-primary btn-lg btn-block align-center" type="submit">Pay Now {{$total }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  $(function() {
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
      var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
          'input[type=text]', 'input[type=file]',
          'textarea'
        ].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
      $errorMessage.addClass('hide');
      $('.has-error').removeClass('has-error');
      $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
          $input.parent().addClass('has-error');
          $input.parent().addClass('is-invalid');
          $errorMessage.removeClass('hide');
          e.preventDefault();
        }
      });
      if (!$form.data('cc-on-file')) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
        }, stripeResponseHandler);
      }
    });

    function stripeResponseHandler(status, response) {
      if (response.error) {
        $('.error')
          .removeClass('hide')
          .find('.alert')
          .text(response.error.message);
      } else {
        /* token contains id, last4, and card type */
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        $form.get(0).submit();

      }
    }
  });
</script>
@endsection