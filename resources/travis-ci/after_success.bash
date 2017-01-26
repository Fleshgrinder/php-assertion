#!/usr/bin/env bash

set -o nounset -o errexit -o noclobber -o noglob -o pipefail -o privileged

travis_retry coveralls --no-interaction &
travis_retry test-reporter --no-interaction &
travis_retry ocular code-coverage:upload --format=php-clover build/logs/clover.xml &
wait
