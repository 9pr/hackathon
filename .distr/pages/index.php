{% extends "default.php" %}

{% block main %}

{% include 'main/block.php' %}


{% import 'graph/macro.php' as engagement_graph %}

{% set engagement_graph__segments = [
		{
			name: 'top',
			title: '> 80%',
			description: 'Лоялные сотрудники',
			color: 'blue',
			dasharray: 20,
			dashoffset: 0
		},
		{
			name: 'middle',
			title: '60% &mdash; 80%',
			description: 'Средняя вовлеченность',
			color: 'orange',
			dasharray: 20,
			dashoffset: 80
		},
		{
			name: 'danger',
			title: '> 60%',
			description: 'Средняя вовлеченность',
			color: 'green',
			dasharray: 60,
			dashoffset: 60
		}
	]%}

	{{ engagement_graph.graph('engagement', 'Метрика вовлеченности сотрудников', engagement_graph__segments) }}



{% endblock %}