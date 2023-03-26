<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('mmsp')->group(function () {
    Route::prefix('electronicsInfo')->group(function () {
        // serialNumber
        Route::prefix('serialNumber')->group(function () {
            Route::any('get', function () {
                $host_ip = explode('.', $_SERVER['HTTP_HOST']);
                return response([
                    'data' => $host_ip[3] > 99 ? '70001' . $host_ip[3] : '700001' . $host_ip[3],
                    'origin' => '/mmsp/electronicsInfo/serialNumber',
                    'name' => 'got',
                ], 200);
            });
        });
    });
    // set control
    Route::prefix('communication')->group(function () {
        Route::any('control/{type}', function () {
            return response(
                [
                    'data' => 'self',
                    'origin' => '/mmsp/Communication/Control',
                    'name' => 'wasSet',
                ],
                200
            );
        });
        Route::any('amInControl/get', function () {
            return response(
                [
                    'data' => true,
                    'origin' => '/mmsp/communication/amInControl',
                    'name' => 'got',
                ],
                200
            );
        });
        Route::any('IssueLog/get', function () {
            return response(
                [
                    'data' => [
                        'currentBootCount' => 506,
                        'currentErrorCounts' => [],
                        'currentErrors' => 0,
                        'currentTimestamp' => 706.122,
                        'errors' => [],
                        'pastErrors' => [
                            [
                                'bootCount' => 467,
                                'count' => 1,
                                'extra' => 0,
                                'issue' => "Motherboard Electronic Tag ID write fail",
                                'issueCode' => 121,
                                'level' => "HardwareWarning",
                                'levelCode' => 5,
                                'timestamp' => 3.82,
                            ],
                            [
                                'bootCount' => 468,
                                'count' => 1,
                                'issue' => 'Ion source pressure above emission trip threshold',
                                'issueCode' => 64, 'level' => "HardwareError",
                                'levelCode' => 7,
                                'timestamp' => 674699.018,
                            ],
                            [
                                'bootCount' => 468,
                                'count' => 2,
                                'extra' => 0,
                                'issue' => 'Filament Potential',
                                'issueCode' => 166,
                                'level' => 'HardwareAnomaly',
                                'levelCode' => 6,
                                'timestamp' => 674699.643,
                            ],
                            [
                                'bootCount' => 469,
                                'count' => 1,
                                'issue' => "Ion source pressure above emission trip threshold",
                                'issueCode' => 64,
                                'level' => "HardwareError",
                                'levelCode' => 7,
                                'timestamp' => 26718.932
                            ],
                        ],
                        'totalErrorCounts' => [
                            'HardwareAnomaly' => 2,
                            'HardwareError' => 2,
                            'HardwareWarning' => 1
                        ],
                        'totalErrors' => 5
                    ],
                    'origin' => '/mmsp/Communication/IssueLog',
                    'name' => 'got',
                ],
                200
            );
        });
    });
    // setSetup
    Route::prefix('scanSetup')->group(function () {
        Route::any('set', [MmspScanSetupController::class, 'scanSetup']);
    });
    // sensorIonSource
    Route::prefix('sensorIonSource')->group(function () {
        Route::any('{type}', function () {
            return response(
                [
                    'data' => ["tPunits" => 2],
                    'name' => 'wasSet',
                    'origin' => '/mmsp/sensorIonSource',
                ],
                200
            );
        });
    });
    // measurement
    Route::prefix('measurement')->group(function () {
        Route::any('data/get', [MmspMeasurementController::class, 'getData']);
        Route::any('scansPow2/-1/get', [MmspMeasurementController::class, 'getScanPow2']);
    });

    // generalControl
    Route::prefix('generalControl')->group(function () {
        Route::any('{type}', function (Request $requset, $type) {
            return response(
                [
                    'data' => 'generalControl',
                    'origin' => '/mmsp/generalControl',
                ],
                200
            );
        });
    });
    // status
    Route::prefix('status')->group(function () {
        Route::any('systemStatus/{type}', function () {
            return response(
                [
                    'data' => 2198879122,
                    'origin' => '/mmsp/status/systemStatus',
                    'name' => 'got',
                ],
                200
            );
        });
    });
});
