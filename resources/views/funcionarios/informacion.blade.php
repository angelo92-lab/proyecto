@extends('layouts.app') {{-- Asegúrate de que tu layout principal se llama así --}}

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Información del Colegio República de Chile</h1>

    <div class="mb-4">
        <h3>📍 Dirección</h3>
        <p>Plaza de Armas N° 40, Monte Patria, Región de Coquimbo</p>
    </div>

    <div class="mb-4">
        <h3>📞 Contacto</h3>
        <ul>
            <li><strong>Teléfono:</strong> 92571268</li>
            <li><strong>Email:</strong> crepdechile@hotmail.com</li>
            <li><strong>Instagram:</strong> <a href="https://www.instagram.com/crepdechileccaa/" target="_blank">@crepdechileccaa</a></li>
        </ul>
    </div>

    <div class="mb-4">
        <h3>🎯 Misión</h3>
        <p>El Colegio República de Chile es un establecimiento educacional humanista que trabaja en tres niveles educativos: prebásica, básica completa y educación media, en modalidades diurna y nocturna. Está comprometido con el desarrollo de habilidades para el siglo XXI, tales como maneras de pensar, maneras de trabajar, herramientas para trabajar y maneras de vivir el mundo, centrándose en valores como el respeto, la responsabilidad y la solidaridad.</p>
    </div>

    <div class="mb-4">
        <h3>🌟 Visión</h3>
        <p>Ser un establecimiento reconocido por la capacidad de innovar y desarrollar procesos formativos diversificados que promuevan las habilidades para el siglo XXI, fomentando la creatividad, resolución de problemas, comunicación y pensamiento crítico, en armonía con los intereses individuales, las emociones y los valores universales, para ser partícipes en la construcción de nuestra sociedad.</p>
    </div>

    <div class="mb-4">
        <h3>📚 Documentos Institucionales</h3>
        <ul>
            <li><a href="https://cdnsae.mineduc.cl/documentos/799/ProyectoEducativo799.pdf" target="_blank">Proyecto Educativo Institucional (PEI)</a></li>
            <li><a href="https://cdnsae.mineduc.cl/documentos/799/ReglamentodeConvivencia799.pdf" target="_blank">Reglamento de Convivencia Escolar</a></li>
            <li><a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/799/ReglamentoDeEvaluacion799.pdf" target="_blank">Reglamento de Evaluación</a></li>
        </ul>
    </div>
</div>
@endsection
