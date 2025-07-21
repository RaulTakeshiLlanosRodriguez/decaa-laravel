@extends('layouts.app')
@section('contenido')
    <section class="innovaciones-container">
        <h2>Publicaciones</h2>
        <div class="publicaciones-grid">
            <div class="guia-card">
                <img src={{ asset('assets/modelo-acreditacion-2025.png') }} alt="Portada de la guía">
                <div class="guia-body">
                    <a href="https://unsanta-my.sharepoint.com/:b:/g/personal/oaac_uns_edu_pe/EfpfViqmubpHuMy4lK86W6EBahsF1Bp879M0dF2oLnU1rg?e=obN8TO"
                        target="_blank"><i class="fas fa-file-pdf"></i>
                        Nuevo Modelo SINEACE 2025
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
