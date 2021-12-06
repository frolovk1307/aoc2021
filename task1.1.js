prev = 0;
$('pre').innerText.split('\n').reduce(function(count, next) {count += next > prev ? 1 : 0; prev = next; return count}, 0)