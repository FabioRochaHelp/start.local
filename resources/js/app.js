import './bootstrap';
import 'morris.js/morris.css';
import 'raphael/raphael.min.js';
import 'morris.js/morris.min.js';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import annotationPlugin from 'chartjs-plugin-annotation';

Chart.register(annotationPlugin);

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();