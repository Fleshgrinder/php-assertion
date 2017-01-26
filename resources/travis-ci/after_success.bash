#!/usr/bin/env bash

set -o nounset -o errexit -o noclobber -o noglob -o pipefail -o privileged

if [[ "${TRAVIS_PHP_VERSION}" == "${COVERAGE_VERSION}" ]]
then
	travis_retry coveralls --no-interaction &
	travis_retry test-reporter --no-interaction &
	travis_retry ocular code-coverage:upload --format=php-clover build/logs/clover.xml &
	wait
fi
