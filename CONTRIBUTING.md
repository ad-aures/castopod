# Contributing to Castopod Host

Love Castopod Host and want to help? Thanks so much, there's something to do for
everybody!

Please take a moment to review this document in order to make the contribution
process easy and effective for everyone involved.

Following these guidelines helps to communicate that you respect the time of the
developers managing and developing this open source project. In return, they
should reciprocate that respect in addressing your issue or assessing patches
and features.

⚠️ Note that **any** contribution made on a repository other than
[the original repository](https://code.podlibre.org/podlibre/castopod-host) will
not be accepted.

## Using the issue tracker

The [issue tracker](https://code.podlibre.org/podlibre/castopod-host/-/issues)
is the preferred channel for [bug reports](#bug-reports),
[features requests](#feature-requests) and
[submitting pull requests](#pull-requests).

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

> [Issue templates](https://docs.gitlab.com/ee/user/project/description_templates.html#using-the-templates)
> have been created for this project. You may use them to help you follow those
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

1. [Fork](https://docs.gitlab.com/ee/gitlab-basics/fork-project.html) the
   project, clone your fork, and configure the remotes:

```bash
# Clone your fork of the repo into the current directory
git clone https://code.podlibre.org/<your-username>/castopod-host.git

# Navigate to the newly cloned directory
cd castopod-host

# Assign the original repo to a remote called "upstream"
git remote add upstream https://code.podlibre.org/podlibre/castopod-host.git
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

**IMPORTANT**: By submitting a patch, you agree to allow the project owners to
license your work under the terms of the
[GNU AGPLv3](https://code.podlibre.org/podlibre/castopod-host/-/blob/main/LICENSE).

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
