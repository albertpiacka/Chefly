@extends('layouts.app', ['class' => 'Chefly'])

@section('content')
    <div class="wrapper" data-aos="fade-up">
        <section class="intro">
            <header data-aos="fade-right">
                <h1>Publishing platform for food enthusiasts</h1>
            </header>
    
            <main data-aos="fade-right" data-aos-delay="300">
                <p>
                    Create beautiful, independent online publication by writing faster and better than you ever have before.
                </p>
            </main>
    
            <footer data-aos="fade-right" data-aos-delay="500">
                <b-button pill size="lg" variant="warning" class="text-white" href="{{ route('register') }}">Get started - <small>it's free</small></b-button>
            </footer>
        </section>
    </div>
@endsection

