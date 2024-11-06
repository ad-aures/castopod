# Contributing to Castopod

Love Castopod and want to help? Thanks so much, there's something to do for
everybody!

> [!NOTE]  
> Castopod follows the [all contributors](https://allcontributors.org/)
> specification in an effort to **recognize any kind of contribution**, not just
> code!  
> If you've made a contribution and do not appear in the
> [contributors](../index.md#contributors-✨) list, please
> [let us know](../index.md#contact) so we can correct our mistake! 🙂

Please take a moment to review this document in order to make the contribution
process easy and effective for everyone involved.

Following these guidelines helps to communicate that you respect the time of the
developers managing and developing this open source project. In return, they
should reciprocate that respect in addressing your issue or assessing patches
and features.

## Translating Castopod

We use [Crowdin](https://translate.castopod.org/) to manage translation files
for [Castopod](https://code.castopod.org/), the
[documentation](https://docs.castopod.org/) and the
[landing](https://castopod.org/) websites.

Whether you'd like to correct a translation error, validate new translations or
include your language to Castopod, head into the
[crowdin project](https://translate.castopod.org/) to get started.

> [!NOTE]  
> To prevent degrading user experience, new languages are included to Castopod
> when they reach a certain threshold (~90%).

## Using the issue tracker

The [issue tracker](https://code.castopod.org/adaures/castopod/-/issues) is the
preferred channel for [bug reports](#bug-reports),
[features requests](#feature-requests) and
[submitting pull requests](#pull-requests).

## ⚠️ Security issues and vulnerabilities

If you encounter any security issue or vulnerability in the Castopod source,
please contact us directly by email at
[security@castopod.org](mailto:security@castopod.org)

## Bug reports

A bug is a _demonstrable problem_ that is caused by the code in the repository.
Good bug reports are extremely helpful - thank you!

Guidelines for bug reports:

1. **Use the issue search** &mdash; check if the issue has already been
   reported.

2. **Check if the issue has been fixed** &mdash; try to reproduce it using the
   latest `main` branch in the repository.

3. **Isolate the problem** &mdash; ideally create a
   [reduced test case](https://css-tricks.com/reduced-test-cases/) and a live
   example.

A good bug report shouldn't leave others needing to chase you up for more
information. Please try to be as detailed as possible in your report. What is
your environment? What steps will reproduce the issue? What browser(s) and OS
experience the problem? What would you expect to be the outcome? All these
details will help people to fix any potential bugs.

> [!NOTE]  
> [Issue templates](https://docs.gitlab.com/ee/user/project/description_templates.html#using-the-templates) have
> been created for this project. You may use them to help you follow those
> guidelines.

## Feature requests

Feature requests are welcome. But take a moment to find out whether your idea
fits with the scope and aims of the project. It's up to _you_ to make a strong
case to convince the project's developers of the merits of this feature. Please
provide as much detail and context as possible.

## Pull requests

Good pull requests - patches, improvements, new features - are a fantastic help.
They should remain focused in scope and avoid containing unrelated commits.

**Please ask first** before embarking on any significant pull request (e.g.
implementing features, refactoring code, porting to a different language),
otherwise you risk spending a lot of time working on something that the
project's developers might not want to merge into the project.

Please adhere to the coding conventions used throughout a project (indentation,
accurate comments, etc.) and any other requirements (such as test coverage).

Adhering to the following process is the best way to get your work included in
the project:

1. [Fork](https://docs.gitlab.com/ee/user/project/repository/forking_workflow.html)
   the project, clone your fork, and configure the remotes:

   ```bash
   # Clone your fork of the repo into the current directory
   git clone https://code.castopod.org/<your-username>/castopod.git

   # Navigate to the newly cloned directory
   cd castopod

   # Assign the original repo to a remote called "upstream"
   git remote add upstream https://code.castopod.org/adaures/castopod.git
   ```

2. If you cloned a while ago, get the latest changes from upstream:

   ```bash
   git checkout main
   git pull upstream main
   ```

3. Create a new topic branch (off the `main` branch) to contain your feature,
   change, or fix:

   ```bash
   git checkout -b <topic-branch-name>
   ```

4. Commit your changes in logical chunks. Please adhere to these
   [git commit message guidelines](https://conventionalcommits.org/) or your
   code is unlikely be merged into the main project. Use Git's
   [interactive rebase](https://help.github.com/articles/about-git-rebase/)
   feature to tidy up your commits before making them public.

5. Locally merge (or rebase) the upstream dev branch into your topic branch:

   ```bash
   git pull [--rebase] upstream main
   ```

6. Push your topic branch up to your fork:

   ```bash
   git push origin <topic-branch-name>
   ```

7. [Open a Pull Request](https://docs.gitlab.com/ee/user/project/merge_requests/creating_merge_requests.html#new-merge-request-from-a-fork)
   with a clear title and description.

> [!IMPORTANT]  
> By submitting a patch, you agree to allow the project owners to license your
> work under the terms of the
> [GNU AGPLv3](https://code.castopod.org/adaures/castopod/-/blob/develop/LICENSE.md).

## Collaborating guidelines

There are few basic rules to ensure high quality of the project:

- Before merging, a PR requires at least two approvals from the collaborators
  unless it's an architectural change, a large feature, etc. If it is, then at
  least 50% of the core team have to agree to merge it, with every team member
  having a full veto right. (i.e. every single one can block any PR)
- A PR should remain open for at least two days before merging (does not apply
  for trivial contributions like fixing a typo). This way everyone has enough
  time to look into it.

You are always welcome to discuss and propose improvements to this guideline.
