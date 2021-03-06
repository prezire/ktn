# Contributing to Ktn


Ktn is a community driven project and accepts contributions of code and documentation from the community. These contributions are made in the form of Issues or [Pull Requests](http://help.github.com/send-pull-requests/) on the [Ktn repository](https://github.com/prezire/ktn/>) on GitHub.

Issues are a quick way to point out a bug or enhancement. If you find a bug or documentation error in Ktn then please check a few things first:

1. There is not already an open Issue
2. The issue has already been fixed (check the develop branch, or look for closed Issues)
3. Is it something really obvious that you can fix yourself?

Reporting issues is helpful but an even better approach is to send a Pull Request, which is done by "Forking" the main repository and committing to your own copy. This will require you to use the version control system called Git.

## Guidelines

Before we look into how, here are the guidelines. If your Pull Requests fail
to pass these guidelines it will be declined and you will need to re-submit
when you’ve made the changes. This might sound a bit tough, but it is required
for us to maintain quality of the code-base.

### PHP Style

TODO

### Documentation

TODO

### Branching

Ktn uses the [Git-Flow](http://nvie.com/posts/a-successful-git-branching-model/) branching model which requires all pull requests to be sent to the "develop" branch. This is
where the next planned version will be developed. The "master" branch will always contain the latest stable version and is kept clean so a "hotfix" (e.g: an emergency security patch) can be applied to master to create a new version, without worrying about other features holding it up. For this reason all commits need to be made to "develop" and any sent to "master" will be closed automatically. If you have multiple changes to submit, please place all changes into their own branch on your fork.

One thing at a time: A pull request should only contain one change. That does not mean only one commit, but one change - however many commits it took. The reason for this is that if you change X and Y but send a pull request for both at the same time, we might really want X but disagree with Y, meaning we cannot merge the request. Using the Git-Flow branching model you can create new branches for both of these features and send two requests.

### Signing

No signing is required.


## How-to Guide

You will need to [create a GitHub account](https://github.com/join?source=header-home).

The best way to contribute is to "clone" your fork of Ktn to your development area. That sounds like some jargon, but "forking" on GitHub means "making a copy of that repo to your account" and "cloning" means "copying that code to your environment so you can work on it".

1. Set up Git (Windows, Mac & Linux)
2. Go to the Ktn repo
3. Fork it
4. Clone your Ktn repo from [https://github.com/prezire/ktn.git]
5. Checkout the "develop" branch. At this point you are ready to start making changes
6. Fix existing bugs on the Issue tracker after taking a look to see nobody else is working on them
7. Commit the files
8. Push your develop branch to your fork
9. Send a pull request [http://help.github.com/send-pull-requests/](http://help.github.com/send-pull-requests/)

### Keeping your fork up-to-date

Unlike systems like Subversion, Git can have multiple remotes. A remote is the name for a URL of a Git repository. By default your fork will have a remote named "origin" which points to your fork, but you can add another remote named "ktn" which points to `https://github.com/prezire/ktn.git`. This is a read-only remote but you can pull from this develop branch to update your own.

If you are using command-line you can do the following:

1. `git remote add ktn https://github.com/prezire/ktn.git`
2. `git pull ktn develop`
3. `git push origin develop`

Now your fork is up to date. This should be done regularly, or before you send a pull request at least.