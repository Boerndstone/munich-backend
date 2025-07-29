#!/bin/bash

# Create a backup of the original file
cp munich.sql munich.sql.backup

# Convert X'...' hexadecimal JSON data to proper JSON format
# This will convert the hexadecimal strings to actual JSON
python3 -c "
import re
import codecs

def hex_to_json(match):
    hex_string = match.group(1)
    try:
        # Convert hex to bytes, then decode as UTF-8
        json_string = codecs.decode(hex_string, 'hex').decode('utf-8')
        # Escape single quotes for SQL and wrap in quotes
        return \"'\" + json_string.replace(\"'\", \"''\") + \"'\"
    except:
        # If conversion fails, return NULL
        return 'NULL'

# Read the SQL file
with open('munich.sql', 'r', encoding='utf-8', errors='ignore') as f:
    content = f.read()

# Replace X'...' patterns with proper JSON strings
content = re.sub(r\"X'([A-Fa-f0-9]+)'\", hex_to_json, content)

# Write the modified content
with open('munich_fixed.sql', 'w', encoding='utf-8') as f:
    f.write(content)

print('Fixed SQL file created as munich_fixed.sql')
"
