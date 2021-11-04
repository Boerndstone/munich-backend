import React from 'react';
import { render } from 'react-dom';
import RepLogApp from './RepLog/RepLogApp';

import Buttons from './Buttons/EditButton';

render(<RepLogApp />, document.getElementById('lift-stuff-app'));

render(<Buttons />, document.getElementById('edit-button'));
