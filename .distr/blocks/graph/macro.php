{% macro graph(name, title, segments) %}


<figure class="graph graph_{{name}}">
  <h4 class="graph__heading">{{ title }}</h4>
  <div class="graph__content">
    <svg width="100%" height="100%" viewBox="0 0 42 42" class="graph__svg" aria-labelledby="{{ title }}" role="img">
      <title class="graph__title">{{ title }}</title>
      <circle class="graph__hole" cx="21" cy="21" r="15.91549430918954" fill="#fff" role="presentation"></circle>
      <circle class="graph__ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#d2d3d4" stroke-width="5" role="presentation"></circle>
      {% if segments.length %}
        {% for item in segments %}
          {{ segment( item.name, item.title, item.description, item.color, item.dasharray, item.dashoffset ) }}
        {% endfor %}
      {% endif %}
    </svg>
  </div>
  <figcaption class="graph__caption">
    <ul class="graph__caption-list" aria-hidden="true" role="presentation">
      {% if segments.length %}
        {% for item in segments %}
          {{ titles( item.name, item.title, item.description, item.color ) }}
        {% endfor %}
      {% endif %}
    </ul>
  </figcaption>
</figure>

{% endmacro %}


{% macro segment(name, title, description, color, dasharray='', dashoffset='') %}
  <circle class="graph__segment graph__segment_{{ color }}" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="{{ color }}" stroke-width="5" stroke-dasharray="{{ dasharray }} {{ 100-dasharray }}" stroke-dashoffset="{{ dashoffset }}">
    <title class="graph__segment-title">{{ title }}</title>
    <desc class="graph__segment-desc">{{ description }}</desc>
  </circle>
{% endmacro %}


{% macro titles(name, title, description, color) %}
  <li class="graph__caption-item graph__caption-item_{{ color }}">{{ description }}</li>
{% endmacro %}