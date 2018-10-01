<?php
namespace ArminVieweg\Dce\ViewHelpers\Be;

/*  | This extension is made for TYPO3 CMS and is licensed
 *  | under GNU General Public License.
 *  |
 *  | (c) 2012-2018 Armin Vieweg <armin@v.ieweg.de>
 */
use ArminVieweg\Dce\Utility\File;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * This view helper adds inline javascript
 *
 * @package ArminVieweg\Dce
 */
class IncludeJsFileViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * Plain HTML should be returned, no output escaping allowed
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('path', 'string', 'Path to js file');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $absPath = File::get($arguments['path']);
        if ($absPath) {
            $contents = file_get_contents($absPath);
            return '<script type="text/javascript">' . $contents . '</script>';
        }
        return '<script type="text/javascript">console.error("File ' . $arguments['path'] . ' not found.")</script>';
    }
}
