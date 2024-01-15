@extends('frontend.layout')
@section('content')
@section('title', 'İletişim')
<section id="mu-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-contact-area">
                    <!-- start title -->
                    <div class="mu-title">
                        <h2>İletişime Geçin</h2>
                        <p>Bizimle iletişime geçmek için aşağıdaki formu doldurup gönderebilirsiniz.</p>
                    </div>
                    <!-- end title -->
                    <!-- start contact content -->
                    <div class="mu-contact-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mu-contact-left">
                                    <form class="contactform">
                                        <p class="comment-form-author">
                                            <label for="author">İsim <span class="required">*</span></label>
                                            <input type="text" required="required" size="30" value="" name="author">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">E-posta <span class="required">*</span></label>
                                            <input type="email" required="required" aria-required="true" value="" name="email">
                                        </p>
                                        <p class="comment-form-url">
                                            <label for="subject">Konu</label>
                                            <input type="text" name="subject">
                                        </p>
                                        <p class="comment-form-comment">
                                            <label for="comment">Mesaj</label>
                                            <textarea required="required" aria-required="true" rows="8" cols="45" name="comment"></textarea>
                                        </p>
                                        <p class="form-submit">
                                            <input type="submit" value="Mesajı Gönder" class="mu-post-btn" name="submit">
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                    </div>
                    <!-- end contact content -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
