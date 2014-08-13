mcc-codes
=========

A public repository of Merchant Category Codes (MCC) in formats easier to read than most places (i.e. not a PDF).

The same data is available in several formats:

* csv
* small json - no whitespace characters
* formatted json - indented for legibility
* ods (LibreOffice and OpenOffice.org compatible)
* xls (Microsoft Office & useful with many other systems that can read xls)

Fields
======
* Derived MCC - mcc
* edited_description - manually edited, modern text
* combined_description - uses either USDA or IRS
* usda_description - Description from the USDA
* irs_description - Description from IRS
* irs_reportable - Reportable under 6041/6041A and Authority for Exception

Future plans and workflow
=========================
I hope that folks will create pull requests to make this information easier to
read and use. Specifically, the "Edited Description" field is a place where we
can collaboratively go through and fix things like upper case vs. title case.

Preferences for the "Edited Description":

* Shorter is better
* Use descriptions that make the most sense to someone in 2014
* Use title case

If the pull request is against the CSV I'll gladly update the binary formats. Or see below for how to update everything in one shot.

Credits
=======
I'm building this to benefit the operations and users of https://www.card.com

We may add more data to this at some point and will share updates. 
Others (e.g. Expensify) are contributing fixes too. Thanks!

Updating the files
==================
1. Start with a csv file that is in a good state.
2. Open it with LibreOffice using only commas as field separators.
3. "Save as" to ods.
4. "Save as" to xls.
5. php -f csv-to-json.php mcc_codes.csv mcc_codes.small.json
6. cat mcc_codes.small.json | json > mcc_codes.json

Step 5 assumes a working php-cli.
Step 6 assumes a working node.js & "[json](https://github.com/trentm/json)" 