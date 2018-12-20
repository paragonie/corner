<?php
declare(strict_types=1);
namespace ParagonIE\Corner;

/**
 * Trait CornerTrait
 * @package ParagonIE\Corner
 */
trait CornerTrait
{
    /** @var string $helpfulMessage */
    protected $helpfulMessage = '';

    /** @var string $supportLink */
    protected $supportLink = '';

    /**
     * Returns a more significant message.
     *
     * One way to think about this is to treat Throwable::getMessage() as the
     * subject line and CornerInterface::getHelpfulMessage() as the body of an
     * email.
     *
     * The output should be allowed to contain newline characters, ASCII art
     * diagrams, etc. Make it helpful for the developer.
     *
     * @return string
     */
    public function getHelpfulMessage(): string
    {
        if (empty($this->helpfulMessage)) {
            return static::HELPFUL_MESSAGE;
        }

        return $this->helpfulMessage;
    }

    /**
     * Return an excerpt of the source code that triggered this exception.
     *
     * @param int $linesBefore
     * @param int $linesAfter
     * @param int $traceWalk
     * @return string
     */
    public function getSnippet(int $linesBefore = 0, int $linesAfter = 0, int $traceWalk = 0): string
    {
        if ($traceWalk === 0) {
            $file = new \SplFileObject($this->getFile());
            /** @var int $line */
            $line = $this->getLine() - 1;
        } else {
            $traceWalk--;
            // We're walking down the stack trace.
            /** @var array<int, array<string, string|int>> $trace */
            $trace = $this->getTrace();
            if (!isset($trace[$traceWalk])) {
                return '';
            }
            if (!isset($trace[$traceWalk]['file'])) {
                // We cannot excerpt this file.
                return '';
            }
            $file = new \SplFileObject((string) $trace[$traceWalk]['file']);
            /** @var int $line */
            $line = (int) ($trace[$traceWalk]['line']) - 1;
            $linesAfter++;
        }
        $min = $line - $linesBefore;
        if ($min < 0) {
            $min = 0;
        }

        $iterator = new \LimitIterator($file, $min, $linesAfter + 1);
        $buffer = "";
        /** @var string $text */
        foreach ($iterator as $text) {
            $buffer .= $text;
        }
        return $buffer;
    }

    /**
     * Returns a string containing either an email address or an https:// URL
     * linking to the most relevant help file possible for this Throwable object.
     *
     * If possible, link to a specific section of your project's documentation
     * (including page anchors, if applicable) to get the developer closer to
     * the solution to whatever problem they're encountering.
     *
     * If this is an exception for which no immediate solution is documented,
     * the link should take the user to the bug tracker and/or reporting tool
     * for your project.
     *
     * In the case where no public bug tracker is used for the project in question,
     * an email address (or comma-separated list of email addresses) is acceptable
     * here too.
     *
     * The intent of this method is to give the developer using your project the
     * quickest possible path to troubleshooting and solving the problem that
     * they're most likely facing if this Throwable gets thrown.
     *
     * @return string
     */
    public function getSupportLink(): string
    {
        if (empty($this->supportLink)) {
            return static::SUPPORT_LINK;
        }
        return $this->supportLink;
    }

    /**
     * See: self::getHelpfulMessage(). This is the setter counterpart.
     * Mutates the object (changes its state in place rather than returning a
     * new object).
     *
     * @param string $message
     * @return CornerInterface
     */
    public function setHelpfulMessage(string $message): CornerInterface
    {
        $this->helpfulMessage = $message;
        return $this;
    }

    /**
     * See: self::getSupportLink(). This is the setter counterpart.
     * Mutates the object (changes its state in place rather than returning a
     * new object).
     *
     * @param string $url
     * @return CornerInterface
     */
    public function setSupportLink(string $url): CornerInterface
    {
        $this->supportLink = $url;
        return $this;
    }
}
