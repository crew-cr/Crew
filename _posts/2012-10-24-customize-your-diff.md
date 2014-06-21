---
layout: post
title: Customize your diff
---

Crew has a new feature : it's now possible to choose the Git references you want to compare (by default the feature branch is compared to the base branch).

In case of there are a lot of review requests on the same feature branch, you can now choose (for instance) to only see the differences since the previous review request.

Above the file list or the diff view, you have two selectors to customize.

![Where](/images/screenshots/where.png)

Each of these selectors displays every commit available in the feature branch and not in the base branch.

![Diff File](/images/screenshots/file-diff.png)

Commits related to the review request are easily identifiable.

![Commit Selector](/images/screenshots/commit-selector.png)

To use this feature, you just have to refer to this [README](https://github.com/pmsipilot/Crew/blob/master/update/README.md) and update your instance of Crew.

Thanks to [@srogier](https://twitter.com/srogier) for this new feature !