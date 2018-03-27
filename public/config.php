<?php
define("TOKEN", "whlYh43GG5TyWDGu");                                        // The secret token to add as a GitHub or GitLab secret, or otherwise as https://www.example.com/?token=secret-token
define("REMOTE_REPOSITORY", "git@github.com:ChiuW/XWallet-backend.git");    // The SSH URL to your repository
define("DIR", "/var/www/html/");                                            // The path to your repostiroy; this must begin with a forward slash (/)
define("BRANCH", "refs/heads/master");                                      // The branch route
define("LOGFILE", "depoly.log");                                            // The name of the file you want to log to.
define("GIT", "/usr/bin/git");                                              // The path to the git executable
define("AFTER_PULL", "");                                                   // A command to execute after successfully pulling
//test1