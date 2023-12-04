<?php 
    require_once("templates/header.php");
?>

<link rel="stylesheet" href="<?= $BASE_URL ?>css/index.css">

<div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">
        Veja as críticas dos últimos filmes adicionados no Cinepop
    </p>
    <div class="movies-container"></div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        <div class="card movie-card">
            <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/movies/movie_cover.png');"></div>
            <div class="card-body">
                <p class="card-rating">
                    <img class="card-rating-img" src="<?= $BASE_URL ?>img/logo.svg" alt="">
                    <span class="rating">9</span>
                </p>
                <h5 class="card-title">
                    <a href="#">Título do filme</a>
                </h5>
                <a href="#" class="btn btn-primary rate-btn">Avaliar</a>
                <a href="#" class="btn btn-primary card-btn">Conhecer</a>
            </div>
        </div>
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">

    </div>
</div>

<?php 
    require_once("templates/footer.php");
?>
