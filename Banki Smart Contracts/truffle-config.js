const path = require("path");
const fs = require('fs');
const HDWalletProvider = require("@truffle/hdwallet-provider");
const mnemonic = fs.readFileSync(".secret").toString().trim();
module.exports = {
	contracts_build_directory: path.join(__dirname, "client/src/contracts"),
	networks: {
		development: {
			host: "127.0.0.1",
			port: 8545,
			network_id: "*"
		},
		testnet: {
			provider: () => new HDWalletProvider(mnemonic, `https://data-seed-prebsc-1-s1.binance.org:8545`),
			network_id: 97,
			confirmations: 10,
			timeoutBlocks: 200,
			skipDryRun: true,
			from: "0x4fE986B333bA6f9cf604415f610d46f69FA174E9"
		},
		dashboard: {
			port: 24012
		}
	},
	mocha: {},
	compilers: {
		solc: {
			version: "0.8.13"
		}
	},
	db: {
		enabled: false
	}
};
