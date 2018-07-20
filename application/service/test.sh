#!/bin/bash

# 'proxy': '107.172.246.177:80',
# 'proxy-auth': 'helpbondme:6VDcAt1jDCtcaODrQCzX',
# 'proxy-type': 'http'

# casperjs --proxy=107.172.246.177:80 --proxy-auth=helpbondme:6VDcAt1jDCtcaODrQCzX test.js --verbose=true


# curl -v -L  --proxy helpbondme:6VDcAt1jDCtcaODrQCzX@107.172.246.177:80 https://app.aquagenuity.com/api/test
#curl -v http://benmcfarlin.com --output /dev/null
# curl -v --proxy helpbondme:6VDcAt1jDCtcaODrQCzX@107.172.246.177:80 http://benmcfarlin.com --output /dev/null

#curl -v -L https://app.aquagenuity.com/api/test --output /dev/null
# curl -v -L --proxy 107.172.246.177:80 --proxy-user helpbondme:6VDcAt1jDCtcaODrQCzX https://app.aquagenuity.com/api/test --output /dev/null
# curl -v -L --proxy 107.172.246.177:80 --proxy-user helpbondme:6VDcAt1jDCtcaODrQCzX https://techwildcatters.com --output /dev/null

# curl -v -L --proxy 172.245.225.204:80 --proxy-user helpbondme:6VDcAt1jDCtcaODrQCzX https://app.aquagenuity.com/api/test

#curl -v -L -A "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5" --proxy 172.245.225.204:80 --proxy-user helpbondme:6VDcAt1jDCtcaODrQCzX https://app.aquagenuity.com/api/test

# export ENGINE_FLAGS="--proxy=172.245.225.204:80 --proxy-auth=helpbondme:6VDcAt1jDCtcaODrQCzX"
casperjs  --verbose=true test.js




