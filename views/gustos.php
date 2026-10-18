<!-- views/gustos.php — Sección "Mis gustos personales" -->
<article class="gustos">

    <header class="gustos-intro">
        <h2>Mis gustos personales</h2>
        <p>Lo que hago cuando cierro el editor: tiempo con mi pareja, salidas con amigos, videojuegos, pádel y mucha música de fondo.</p>
    </header>

    <section class="gusto" aria-labelledby="g-tiempo">
        <div class="gusto-titulo">
            <svg class="icono" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z"/></svg>
            <h3 id="g-tiempo">Tiempo libre</h3>
        </div>
        <ul class="gusto-lista">
            <li><strong>Con mi pareja</strong> Salir a comer, ver películas y compartir el tiempo libre.</li>
            <li><strong>Con amigos</strong> Salir y pasar el rato juntos.</li>
        </ul>
    </section>

    <section class="gusto" aria-labelledby="g-deporte">
        <div class="gusto-titulo">
            <svg class="icono" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M12 8l3.2 2.3-1.2 3.7h-4l-1.2-3.7z"/><path d="M12 4v4M15.2 10.3l3.9-1.2M14 14l2.4 3.3M10 14l-2.4 3.3M8.8 10.3L4.9 9.1"/></svg>
            <h3 id="g-deporte">Deporte</h3>
        </div>
        <dl class="gusto-pares">
            <div><dt>Pádel</dt><dd>El que juego.</dd></div>
            <div><dt>Fútbol</dt><dd>El que veo.</dd></div>
        </dl>
    </section>

    <section class="gusto" aria-labelledby="g-juegos">
        <div class="gusto-titulo">
            <svg class="icono" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 8h10a4 4 0 0 1 4 4.5l-.6 3.6a2 2 0 0 1-3.5.9L15 15H9l-1.9 2a2 2 0 0 1-3.5-.9L3 12.5A4 4 0 0 1 7 8z"/><path d="M8 11v3M6.5 12.5h3"/><circle cx="16" cy="11.5" r=".6"/><circle cx="17.5" cy="13.5" r=".6"/></svg>
            <h3 id="g-juegos">Videojuegos</h3>
        </div>
        <ul class="etiquetas">
            <li>EA Sports FC 27</li>
            <li>Valorant</li>
            <li>Rainbow Six Siege</li>
        </ul>
    </section>

    <section class="gusto gusto-musica" aria-labelledby="g-musica">
        <div class="gusto-titulo">
            <svg class="icono" viewBox="0 0 24 24" aria-hidden="true"><path d="M9 18V6l11-2v12"/><circle cx="6.5" cy="18" r="2.5"/><circle cx="17.5" cy="16" r="2.5"/></svg>
            <h3 id="g-musica">Música</h3>
        </div>
        <div class="musica">
            <div class="musica-fav">
                <p class="musica-rotulo">Mi artista favorito</p>
                <p class="musica-artista">Anuel AA</p>
                <p class="musica-genero">Reggaetón, mi género de siempre</p>
            </div>
            <div class="musica-ahora">
                <p class="musica-rotulo">Sonando mucho ahora</p>
                <ul>
                    <li><span class="eq" aria-hidden="true"><i></i><i></i><i></i></span>Clarent</li>
                    <li><span class="eq" aria-hidden="true"><i></i><i></i><i></i></span>Omer Courtz</li>
                </ul>
            </div>
        </div>
        <p class="musica-otros">Y en general escucho de casi todo: bachata, merengue, salsa y vallenato.</p>
    </section>

    <section class="gusto" aria-labelledby="g-tech">
        <div class="gusto-titulo">
            <svg class="icono" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 7l-5 5 5 5M16 7l5 5-5 5M13.5 5l-3 14"/></svg>
            <h3 id="g-tech">Tecnologías</h3>
        </div>
        <dl class="gusto-pares tech">
            <div><dt>PHP</dt><dd>Mi favorito. Aprendí mucho de Laravel en mis prácticas académicas.</dd></div>
            <div><dt>Python</dt><dd>Para análisis de datos, el camino que quiero seguir, junto con Power BI.</dd></div>
            <div><dt>JavaScript</dt><dd>React en el frontend y Node.js en el backend.</dd></div>
            <div><dt>Java</dt><dd>Otro de los lenguajes con los que trabajo.</dd></div>
        </dl>
    </section>

</article>
