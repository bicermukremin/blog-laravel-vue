
@extends('layouts.app')
 
@section('content')
 <hr class="solid my-5" />

            <section id="history" class="mb-4">
              <h1 class="mb-0 text-color-dark">Freelance Web Developer</h1>
              <h2 class="mb-0 text-color-dark">Mükremin Biçer</h2>

              <div class="row" style="background-color: #e09d22;">
                <div class="col-lg-7">
                 
                  <h2 class="mt-4">Misyonumuz</h2>
                  <p class="mt-4">
                    {!! $input['mission'] !!}
                  </p>
                
                </div>
               
              </div>
              <div class="row" style="background-color: #E04622;">
                <div class="col-lg-7">
           
                  <p class="mt-4" >
                    Sayın <strong>{{$input['email']}}</strong>
                  </p>
                  <p class="mt-4">
                    Başarılı bir şekilde abone oldunuz. Blog sayfamıza eklenen bir haber olduğunda size bilgilendirme mesajı gelecektir. En kısa sürede size dönüş yapılacaktır. İlginiz için teşekkürler.
                  </p>
                </div>
               
              </div>
            </section>

            <hr class="solid my-5" />
   
@stop