import { startStimulusApp } from '@symfony/stimulus-bridge';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));
import { startStimulusApp } from "@symfony/stimulus-bridge";
import { Autocomplete } from "stimulus-autocomplete";

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
const app = startStimulusApp(
  require.context(
    "@symfony/stimulus-bridge/lazy-controller-loader!./controllers",
    true,
    /\.[jt]sx?$/
  )
);
app.register("autocomplete", Autocomplete);

export { app };

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
