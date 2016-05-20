<?php

//menu.html.twig



<div id="wrapper">
    <div id="container">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ path('homepage') }}">Brafin</a>


                    <ul class="nav navbar-nav">
                        <li class="">
                            <a href="index.php">News</a>
                        </li> 
                    </ul>
                </div>

                <!--SEARCH-->
                <form method="get" action="{{ path('homepage') }}" class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" value="" name="search" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default btn-primary">Search</button>
                </form>

            </div>
        </nav>     

    </div>
</div>
        
        
        
        
        
        //index.html.twig
        
        {% extends 'base.html.twig' %}

{% block body %}
    {% block menu %}
        {{ parent() }}
        
        {% block javascripts %}
            {% stylesheets '@jquery @bootstrap_js' %}
                <link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
            {% endstylesheets %}
            {% stylesheets '@AppBundle/Resources/public/js/script.js' filter="cssrewrite" %}
                <link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
            {% endstylesheets %}
        {% endblock %}
    {% endblock %}
{% endblock %}

{% block stylesheets %}
    {% stylesheets '@bootstrap_css' %}
        <link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
    {% endstylesheets %}
    {% stylesheets '@AppBundle/Resources/public/css/style.css' filter="cssrewrite" %}
        <link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
    {% endstylesheets %}
{% endblock %}




//config.yml


# Assetic Configuration
assetic:
    debug:          '%kernel.debug%'
#    use_controller: false
    use_controller: false
    filters:
        cssrewrite: ~        
    
    assets:
        bootstrap_js:
            inputs:
                - %kernel.root_dir%/../vendor/twitter/bootstrap/dist/js/bootstrap.js
        bootstrap_css:
            inputs:
                - %kernel.root_dir%/../vendor/twitter/bootstrap/dist/css/bootstrap.css
                - %kernel.root_dir%/../vendor/twitter/bootstrap/dist/css/bootstrap-theme.css
            filters: [cssrewrite]

        jquery:
            inputs:
                - %kernel.root_dir%/../vendor/components/jquery/jquery.js

