@extends('frontend.layout')
@section('title', $title)
@section('content')
  <!-- Start error section  -->
  <section id="mu-error">
    <div class="container">
      <div class="row">
       <div class="col-md-12">
          <div class="mu-error-area">
            <p>Oops! The page you requested was not found!</p>
            <span>The page you are looking for is not available or has been removed or changed.</span>
            <h2>404</h2>
            <a class="mu-post-btn" href="{{route('post.index')}}">GO TO HOME</a>
          </div>
        </div>
      </div>
    </div>
  </section>
 <!-- End error section  -->
 @endsection