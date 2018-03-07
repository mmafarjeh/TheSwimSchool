@extends('layouts.app-uikit')

@section('seo')
    <title>Parrish Swim School Lifeguarding | Bradenton CPR/First Aid | Palmetto</title>
    <meta name="description" content="We are also proud to offer Parrish swim school lifeguarding, along with Bradenton CPR/first aid training! Contact The Swim School near Palmetto today for more information."/>
@endsection

@section('heading')
    Other Services
@endsection

@section('content')


    <div class="uk-section-default uk-section-overlap uk-section" uk-scrollspy="{&quot;target&quot;:&quot;[uk-scrollspy-class]&quot;,&quot;cls&quot;:&quot;uk-animation-slide-top-medium&quot;,&quot;delay&quot;:false}">
        <div class="uk-container">
            <div class="uk-grid-large uk-flex-middle uk-margin-large uk-grid" uk-grid="">
                <div class="uk-width-expand@m">
                    <div class="uk-margin uk-scrollspy-inview uk-animation-slide-right-medium" uk-scrollspy-class="uk-animation-slide-right-medium">
                        <img src="/img/lifeguard.jpg" class="el-image uk-box-shadow-xlarge" alt="Manatee County Lifeguarding">
                    </div>
                </div>
                <div class="uk-width-expand@m uk-flex-first@m uk-first-column">
                    <h1 class="uk-h2 uk-heading-bullet uk-scrollspy-inview uk-animation-slide-top-medium" uk-scrollspy-class="">Lifeguarding</h1>
                    <div class="uk-margin-medium uk-text-left@m uk-text-center uk-scrollspy-inview uk-animation-slide-left-medium" uk-scrollspy-class="uk-animation-slide-left-medium">
                        Hire The Swim School to supervise your next pool party or event by the water. We have certified lifeguards to keep everyone safe while you enjoy the party! We can even provide extra fun with pool games for a small additional cost.</div>
                    <div class="uk-margin uk-scrollspy-inview uk-animation-slide-top-medium" uk-scrollspy-class="">
                        <a title="Lakewood Ranch lifeguard" class="el-content uk-button uk-button-primary" href="/lifeguarding/">Book Lifeguard</a>
                    </div>
                </div>
            </div>
            <div class="uk-grid-large uk-flex-middle uk-margin-large uk-grid" uk-grid="">
                <div class="uk-width-expand@m uk-first-column">
                    <div class="uk-margin" uk-scrollspy-class="uk-animation-slide-right-medium" style="visibility: hidden;">
                        <img src="/img/cpr-first-aid.jpg" class="el-image uk-box-shadow-xlarge" alt="Myakka City first aid training">
                    </div>
                </div>
                <div class="uk-width-expand@m">
                    <h1 class="uk-h2 uk-heading-bullet" uk-scrollspy-class="" style="visibility: hidden;">CPR/First Aid Training</h1>
                    <div class="uk-margin-medium uk-text-left@m uk-text-center" uk-scrollspy-class="uk-animation-slide-left-medium" style="visibility: hidden;">
                        Need CPR and/or First Aid training? The Swim School can certify you with these life-saving skills. Individual and group instruction is available. </div>
                    <div class="uk-margin" uk-scrollspy-class="" style="visibility: hidden;">
                        <a title="Ellenton first aid training" class="el-content uk-button uk-button-primary" href="/cpr-first-aid/">Sign Up for Training</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection