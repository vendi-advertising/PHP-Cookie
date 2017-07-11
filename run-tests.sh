#!/bin/bash
#
# The MIT License (MIT)
#
# Copyright (c) 2014 Mathias Leppich <mleppich@muhqu.de>
#
# Copyright (c) 2017 Leonidas Villeneuve <leonidas@leonidasv.com>
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.

#https://github.com/Jmeyering/php-fpm-cli/blob/master/php-fpm-cli

#First time execution dependency install (Ubuntu only)
if [ $(lsb_release -a 2>/dev/null | grep -c "Ubuntu") = 2 ] && [ ! -f $HOME/.php-fpm-cli ] && [ $(dpkg-query -W -f='${Status}' libfcgi0ldbl 2>/dev/null | grep -c "ok installed") = 0 ]; then
    echo "This application depends on libfcgi0ldbl, which is not installed on your system. This script will install it now.";
    sudo apt-get install libfcgi0ldbl;
    echo ' ' > $HOME/.php-fpm-cli;
   elif [ $(lsb_release -a 2>/dev/null | grep -c "Ubuntu") -eq 2 ] && [ $(dpkg-query -W -f='${Status}' libfcgi0ldbl 2>/dev/null | grep -c "ok installed") -eq 1 ]; then
    echo ' ' > $HOME/.php-fpm-cli;
fi

#https://stackoverflow.com/a/21188136/231316
get_abs_filename() {
  # $1 : relative filename
  echo "$(cd "$(dirname "$1")" && pwd)/$(basename "$1")"
}

main() {
    PHPFPMCLI_FILE=$(get_abs_filename "tests/index.php")
    SCRIPT_FILENAME=$PHPFPMCLI_FILE \
    REQUEST_METHOD=GET \
    cgi-fcgi -bind -connect "/var/run/php/php7.1-fpm.sock" | stripheaders
}

stripheaders() {
    sed -E '1,/^.$/ d'
}
main
