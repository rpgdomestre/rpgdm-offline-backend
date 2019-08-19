---
number: {{ $edition }}
mSubtitle: Edição {{ $edition }}
date: '{{ $released_at  }}'
extends: _layouts.markdown
section: mContent
mTitle: Weekly
mActive: true
mSubheader: true
mNavigation: true
mSectionPrimary: false
mUseMTitleForPageTitle: true
mContentClasses: weekly
description: >-
    {{ substr(str_replace(array("\r", "\n"), ' ', $description), 0, 299) }}
---
