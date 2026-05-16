const path = require('path');
const webpack = require('webpack');

const isProduction = process.argv.includes('--production');

if (isProduction && !process.argv.includes('-p')) {
    process.argv.push('-p');
}

process.env.NODE_ENV = 'test';
process.env.MIX_FILE = 'webpack.mix';

require('laravel-mix/src/Mix').primary.paths.setRootPath(process.cwd());

require('laravel-mix/setup/webpack.config')()
    .then(config => {
        webpack(config, (error, stats) => {
            if (error) {
                console.error(error);
                process.exit(1);
            }

            if (stats) {
                console.log(stats.toString({
                    all: false,
                    assets: true,
                    colors: true,
                    errors: true,
                    warnings: true,
                }));

                if (stats.hasErrors()) {
                    process.exit(1);
                }
            }
        });
    })
    .catch(error => {
        console.error(error);
        process.exit(1);
    });
