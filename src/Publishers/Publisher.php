<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Assets\Bootstrap53\Publishers;

use BasicApp\Core\Publisher as BasePublisher;

class Publisher extends BasePublisher
{

    const VERSION = '5.3.2';

    protected $destination = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'bootstrap53';

    public $createDestination = true;

    public $url = 'https://github.com/twbs/bootstrap/releases/download/v{v}/bootstrap-{v}-dist.zip';

    public function publish(): bool
    {
        if (count(directory_map($this->destination)) > 0)
        {
            return true;
        }

        return $this->downloadFile(strtr($this->url, ['{v}' => static::VERSION]))
            ->extractZipArchive($this->getScratch() . 'bootstrap-' . self::VERSION . '-dist.zip')
            ->setSource($this->getScratch() . 'bootstrap-' . self::VERSION . '-dist')
            ->addPath('/')
            ->merge(false);
    }

}