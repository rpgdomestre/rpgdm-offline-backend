---
number: {{ $edition }}
date: '{{ $released_at  }}'
extends: _layouts.weekly
section: mContent
description: >-
    {{ substr(str_replace(array("\r", "\n"), ' ', $description), 0, 299) }}
---
