<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Pokémon TCG Database</title>

	<meta name="description" content="Una base de datos del juego de cartas coleccionables de Pokémon.">
	<meta name="author" content="Joaquín de la Iglesia">
	<meta property="og:title" content="Pokémon TCG Database" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://pokemon-tcg-databasee.herokuapp.com/" />
	<meta property="og:image" content="{if $cardUrl != ''}{substr_replace(BASE_URL ,"",-5)}/{$cardURL}{/if}" />
	<meta property="og:description" content="Una base de datos del juego de cartas coleccionables de Pokémon." />

	<link ref="icon" href="favicon.ico" type="image/x-icon">
	<link href="{substr_replace(BASE_URL ,"",-5)}/css/bootstrap.css" rel="stylesheet">
	<link href="{substr_replace(BASE_URL ,"",-5)}/css/style.css" rel="stylesheet">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col px-0">
				<nav class="navbar navbar-expand-sm navbar-light bg-light navbar-dark bg-dark">
					<a class="navbar-brand" href="{substr_replace(BASE_URL ,"",-5)}">Pokémon TCG Database</a>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="{substr_replace(BASE_URL ,"",-5)}/showAllCards">Todas las cartas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Link</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"
									id="navbarDropdownMenuLink" data-toggle="dropdown">Por tipo de carta</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="{substr_replace(BASE_URL ,"",-5)}/byCategories/pokemon">Pokémon</a> 
									<a class="dropdown-item" href="{substr_replace(BASE_URL ,"",-5)}/byCategories/trainers">Entrenador</a>
									<a class="dropdown-item" href="{substr_replace(BASE_URL ,"",-5)}/byCategories/energies">Energía</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle"
									id="navbarDropdownMenuLink" data-toggle="dropdown">Por expansión</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
									{foreach from=$expansions key=key item=expansion}
									<a class="dropdown-item" href="{substr_replace(BASE_URL ,"",-5)}/byExpansion/{$expansions[$key]->id}">{$expansions[$key]->name}</a>
									{/foreach}
								</div>
							</li>
						</ul>
						<form class="form-inline">
							<input class="form-control mr-sm-2" type="text">
							<button class="btn btn-primary my-2 my-sm-0" type="submit">
								Search
							</button>
						</form>
						<ul class="navbar-nav ml-md-auto">
							<li class="nav-item">
								<a class="nav-link" href="{substr_replace(BASE_URL ,"",-5)}/admin">Admin<span class="sr-only">(current)</span></a>
							</li>
						</ul>
					</div>
				</nav>